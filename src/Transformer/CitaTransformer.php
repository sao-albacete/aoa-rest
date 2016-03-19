<?php
/**
 * Created by aoa-rest.
 * User: viktorKhan
 * Date: 19/03/16
 * Time: 11:30
 */
namespace Aoa\Transformer;
use Aoa\Entity\Cita;
use League\Fractal\TransformerAbstract;

/**
 * Class CitaTransformer
 * @author Wonnova
 * @link http://www.wonnova.com
 */
class CitaTransformer extends TransformerAbstract
{
    public function transform (Cita $cita)
    {
        $lugar = $cita->getLugar();
        $especie = $cita->getEspecie();
        $observadorPrincipal = $cita->getObservadorPrincipal();
        $claseReproduccion = $cita->getClaseReproduccion();
        $criterioSeleccion = $cita->getCriterioSeleccionCita();

        return [
            'id' => $cita->getId(),
            'fechaAlta' => $cita->getFechaAlta()->format(\DateTime::W3C),
            'cantidad' => $cita->getCantidad(),
            'observaciones' => $cita->getObservaciones(),
            'seleccionada' => $cita->getIndSeleccionada(),
            'lugar' => [
                'paraje' => $lugar->getNombre(),
                'cuadriculaUtm' => $lugar->getCuadriculaUtm()->getCodigo(),
                'municipio' => $lugar->getMunicipio()->getNombre(),
                'comarca' => $lugar->getComarca()->getNombre(),
            ],
            'esRarezaHomologada' => $cita->getIndRarezaHomologada(),
            'observador' => [
                'codigo' => $observadorPrincipal->getCodigo(),
                'nombre' => $observadorPrincipal->getNombre(),
            ],
            'claseReproduccion' => [
                'codigo' => $claseReproduccion->getCodigo(),
                'tipoCria' => $claseReproduccion->getTipoCria()
            ],
            'fuente' => $cita->getFuente()->getNombre(),
            'enHabitatRaro' => $cita->getIndHabitatRaro(),
            'criaEnHabitatRaro' => $cita->getIndCriaHabitatRaro(),
            'herido' => $cita->getIndHerido(),
            'comportamientoRaro' => $cita->getIndComportamiento(),
            'especie' => [
                'codigo' => $especie->getCodigo(),
                'nombreComun' => $especie->getNombreComun(),
                'genero' => $especie->getGenero(),
                'especie' => $especie->getEspecie(),
                'subespecie' => $especie->getSubespecie(),
            ],
            'criterioSeleccion' => [
                'codigo' => $criterioSeleccion->getCodigo(),
                'nombre' => $criterioSeleccion->getNombre(),
            ],
            'importancia' => $cita->getImportanciaCita()->getCodigo(),
            'estudio' => $cita->getEstudio()->getNombre(),
            'privada' => $cita->getIndPrivacidad(),
            'tieneFotos' => $cita->getIndFoto(),
        ];
    }
}
