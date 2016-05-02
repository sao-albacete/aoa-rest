<?php
namespace Aoa\Service;

use Aoa\Core\Doctrine\Repository\EntityRepositoryInterface;
use Aoa\Entity\AsoCitaClaseEdadSexo;
use Aoa\Entity\Cita;
use Aoa\Entity\ClaseEdadSexo;
use Aoa\Entity\ClaseReproduccion;
use Aoa\Entity\Especie;
use Aoa\Entity\Estudio;
use Aoa\Entity\Fuente;
use Aoa\Entity\Lugar;
use Aoa\Entity\ObservadorPrincipal;
use Aoa\Entity\ObservadorSecundario;
use Aoa\Util\CitaUtil;
use Aoa\Validator\CitaValidator;
use Doctrine\ORM\EntityManagerInterface;

/**
 * Class CitaService
 * @author Wonnova
 * @link http://www.wonnova.com
 */
class CitaService extends AbstractService implements CitaServiceInterface
{
    /**
     * @var EntityRepositoryInterface
     */
    private $repository;

    public function __construct(EntityManagerInterface $em)
    {
        parent::__construct($em);
        $this->repository = $this->em->getRepository(Cita::class);
    }

    /**
     * Find all ocurrences of Cita
     *
     * @param null|array $order
     * @return Cita[]
     */
    public function findAll(array $order = null)
    {
        if (empty($orderBy)) {
            return $this->em->getRepository(Cita::class)->findAll();
        } else {
            return $this->em->getRepository(Cita::class)->findBy([], $orderBy);
        }
    }

    /**
     * Find one cita by id
     *
     * @param $id
     * @return Cita
     */
    public function findOneById($id)
    {
        return $this->em->getRepository(Cita::class)->find($id);
    }

    public function create(array $data)
    {
        // If received data is empty, throw exception
        if (empty($data)) {
            throw new \InvalidArgumentException('empty_data');
        }

        // Validate data
        $validator = new CitaValidator($data);
        if (! $validator->validate()) {
            throw new \InvalidArgumentException($validator->errors());
        }

        // Begin transaction
        $this->beginTransaction();

        try {
            // Constructs Cita entity
            $cita = $this->hydrate($data);
            $especie = $cita->getEspecie();

            // Rareza
            if ($especie->getIndRareza()) {
                $cita->setIndRarezaHomologada(2);
            }

            // Calculate and set "selection criteria"
            $countRecordsByLocation = $this->repository->countBy(
                ['lugar_id = :lugarId'],
                [':lugarId' => $cita->getLugar()->getId()]
            );
            $cita->setCriterioSeleccionCita(
                CitaUtil::calcularCriterioSeleccion($cita, $especie, $countRecordsByLocation)
            );
            // Calculate and set "record importance"
            $cita->setImportanciaCita(CitaUtil::calculateRecordImportance(
                $especie->getIndRareza(),
                $especie->getClasificacionCriterioEsp(),
                $cita->getClaseReproduccion()
            ));

            // Persist cita
            $this->em->persist($cita);
            $this->em->flush();

            // Add ages and genres
            /** @var EntityRepositoryInterface $ageAndGenreRepository */
            $ageAndGenreRepository = $this->em->getRepository(ClaseEdadSexo::class);
            foreach ($data['claseEdadSexo'] as $ageAndGenreCode => $amount) {
                $ageAndGenre = $ageAndGenreRepository->findOneBy(['codigo' => $ageAndGenreCode]);
                if (isset($ageAndGenre)) {
                    $ageAndGenreAmount = new AsoCitaClaseEdadSexo();
                    $ageAndGenreAmount->setCantidad($amount)
                        ->setCita($cita)
                        ->setClaseEdadSexo($ageAndGenre);
                    $this->em->persist($ageAndGenreAmount);
                }
            }

            // TODO Indice privacidad
//        $cita->setIndPrivacidad(CitaUtil::calculateRecordPrivacy($citaId, $citaFechaAlta, $especieId, $claseReproduccionId));

            $this->commit();

        } catch (\Exception $ex) {
            $this->rollback();
            throw $ex;
        }
    }

    /**
     * Hydrat an entity with data from array
     *
     * @param array $data
     * @return Cita
     * @throws \InvalidArgumentException
     */
    public function hydrate(array $data)
    {
        $cita = new Cita();
        $cita->setFechaAlta(new \DateTime($data['fechaAlta']));
        $cita->setCantidad(intval($data['cantidad']));

        $cita->setIndHabitatRaro(isset($data['indHabitatRaro'])?:0);
        $cita->setIndCriaHabitatRaro(isset($data['indCriaHabitatRaro'])?:0);
        $cita->setIndComportamiento(isset($data['comportamiento'])?:0);
        $cita->setIndHerido(isset($data['herido'])?:0);

        // TODO sanityze string
        $cita->setObservaciones((isset($data['observaciones'])?:null));

        // Lugar
        /** @var Lugar $lugar */
        $lugar = $this->em->getRepository(Lugar::class)->findOneBy(['codigo' => $data['lugar_codigo']]);
        if (!empty($lugar)) {
            $cita->setLugar($lugar);
        } else {
            throw new \InvalidArgumentException('invalid_location');
        }
        // Observador principal
        $observadorPrincipal = $this->em->getRepository(ObservadorPrincipal::class)->findOneBy(
            ['codigo' => $data['observador_principal_codigo']]
        );
        if (!empty($observadorPrincipal)) {
            $cita->setObservadorPrincipal($observadorPrincipal);
        } else {
            throw new \InvalidArgumentException('invalid_main_observer');
        }
        // Especie
        /** @var Especie $especie */
        $especie = $this->em->getRepository(Especie::class)->findOneBy(
            ['codigo' => $data['especie_code']]
        );
        if (!empty($especie)) {
            $cita->setEspecie($especie);
        } else {
            throw new \InvalidArgumentException('invalid_species');
        }

        // Fuente
        if (! isset($data['fuente_codigo']) || empty($data['fuente_codigo'])) {
            $data['fuente_codigo'] = Fuente::DEFAULT_CODE;
        }
        $fuente = $this->em->getRepository(Fuente::class)->findOneBy(['codigo' => $data['fuente_codigo']]);
        if (!empty($fuente)) {
            $cita->setFuente($fuente);
        } else {
            throw new \InvalidArgumentException('invalid_source');
        }
        // Estudio
        if (! isset($data['estudio_codigo']) || empty($data['estudio_codigo'])) {
            $data['estudio_codigo'] = Estudio::DEFAULT_CODE;
        }
        $estudio = $this->em->getRepository(Estudio::class)->findOneBy(['codigo' => $data['estudio_codigo']]);
        if (!empty($estudio)) {
            $cita->setEstudio($estudio);
        } else {
            throw new \InvalidArgumentException('invalid_study');
        }
        // Clase reproduccion
        if (! isset($data['clase_reproduccion_codigo']) || empty($data['clase_reproduccion_codigo'])) {
            $data['clase_reproduccion_codigo'] = ClaseReproduccion::DEFAULT_CODE;
        }
        $claseReproduccion = $this->em->getRepository(ClaseReproduccion::class)->findOneBy(
            ['codigo' => $data['clase_reproduccion_codigo']]
        );
        if (!empty($claseReproduccion)) {
            $cita->setClaseReproduccion($claseReproduccion);
        } else {
            throw new \InvalidArgumentException('invalid_reproduction_kind');
        }

        // Add collaborators
        if (isset($data['colaboradores'])) {
            /** @var EntityRepositoryInterface $collaboratorRepository */
            $collaboratorRepository = $this->em->getRepository(ObservadorSecundario::class);
            $collaborators = explode(',', $data['colaboradores']);
            foreach ($collaborators as $collaboratorCode) {
                /** @var ObservadorSecundario $collaborator */
                $collaborator = $collaboratorRepository->findOneBy(['codigo' => $collaboratorCode]);
                if (isset($collaborator)) {
                    $cita->addObservadorSecundario($collaborator);
                }
            }
        }

        return $cita;
    }
}
