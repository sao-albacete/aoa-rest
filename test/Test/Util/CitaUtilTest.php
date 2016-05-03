<?php
namespace Aoa\Test\Util;
use Aoa\Entity\Cita;
use Aoa\Entity\ClaseReproduccion;
use Aoa\Entity\ClasificacionCriterioEsp;
use Aoa\Entity\Especie;
use Aoa\Util\CitaUtil;

/**
 * Class CitaUtilTest
 * @author viktorKhan
 * @link https://github.com/viktorKhan
 */
class CitaUtilTest extends \PHPUnit_Framework_TestCase
{
    public function testCalculateRecordImportanceOk()
    {

    }

    /**
     * @test
     */
    public function testCalcularCriterioSeleccionE1()
    {
        $classifCriteria = new ClasificacionCriterioEsp();
        $especie = new Especie();
        $especie->setClasificacionCriterioEsp($classifCriteria);

        $classifReprod = new ClaseReproduccion();
        $cita = new Cita();
        $cita->setClaseReproduccion($classifReprod)
            ->setFechaAlta(new \DateTime('2016-05-01'));

        $cita->getClaseReproduccion()->setCodigo('MC');

        // Valid criteria classification
        foreach ([12, 13, 14] as $validClasifCrit) {
            $especie->getClasificacionCriterioEsp()->setCodigo($validClasifCrit);
            $this->assertEquals('E1', CitaUtil::calcularCriterioSeleccion($cita, $especie, 0));
        }
        // Valid reproduction classification
        foreach (['MC', 'PP', 'PN', 'CN', 'DD', 'NV', 'JO', 'CB', 'NI'] as $validClasifReprod) {
            $cita->getClaseReproduccion()->setCodigo($validClasifReprod);
            $this->assertEquals('E1', CitaUtil::calcularCriterioSeleccion($cita, $especie, 0));
        }
        // Invalid reproduction classification
        foreach (['SP', 'NA', 'NC'] as $invalidClasifReprod) {
            $cita->getClaseReproduccion()->setCodigo($invalidClasifReprod);
            $this->assertNotEquals('E1', CitaUtil::calcularCriterioSeleccion($cita, $especie, 0));
        }
    }

    /**
     * @test
     */
    public function testCalcularCriterioSeleccionA1()
    {
        $classifCriteria = new ClasificacionCriterioEsp();
        $especie = new Especie();
        $especie->setClasificacionCriterioEsp($classifCriteria);

        $classifReprod = new ClaseReproduccion();
        $cita = new Cita();
        $cita->setClaseReproduccion($classifReprod)
            ->setFechaAlta(new \DateTime('2016-05-01'));

        // Valid criteria classification
        foreach ([10, 12, 13] as $validClasifCrit) {
            $especie->getClasificacionCriterioEsp()->setCodigo($validClasifCrit);
            $this->assertEquals('A1', CitaUtil::calcularCriterioSeleccion($cita, $especie, 0));
        }

        $especie->getClasificacionCriterioEsp()->setCodigo(14);
        $this->assertNotEquals('A1', CitaUtil::calcularCriterioSeleccion($cita, $especie, 0));
    }

    /**
     * @test
     */
    public function testCalcularCriterioSeleccionG1()
    {
        $classifCriteria = new ClasificacionCriterioEsp();
        $especie = new Especie();
        $especie->setClasificacionCriterioEsp($classifCriteria);

        $classifReprod = new ClaseReproduccion();
        $cita = new Cita();
        $cita->setClaseReproduccion($classifReprod)
            ->setFechaAlta(new \DateTime('2016-05-01'));

        // Valid criteria classification
        foreach ([11] as $validClasifCrit) {
            $especie->getClasificacionCriterioEsp()->setCodigo($validClasifCrit);
            $this->assertEquals('G1', CitaUtil::calcularCriterioSeleccion($cita, $especie, 0));
        }

        $especie->getClasificacionCriterioEsp()->setCodigo(14);
        $this->assertNotEquals('G1', CitaUtil::calcularCriterioSeleccion($cita, $especie, 0));
    }

    /**
     * @test
     */
    public function testCalcularCriterioSeleccionD3()
    {
        $classifCriteria = new ClasificacionCriterioEsp();
        $especie = new Especie();
        $especie->setClasificacionCriterioEsp($classifCriteria);

        $classifReprod = new ClaseReproduccion();
        $cita = new Cita();
        $cita->setClaseReproduccion($classifReprod)
            ->setFechaAlta(new \DateTime('2016-05-01'));

        $cita->setCantidad(5);
        // Valid criteria classification
        foreach ([30] as $validClasifCrit) {
            $especie->getClasificacionCriterioEsp()->setCodigo($validClasifCrit);
            $this->assertEquals('D3', CitaUtil::calcularCriterioSeleccion($cita, $especie, 0));
        }

        $cita->setCantidad(4);
        $this->assertNotEquals('D3', CitaUtil::calcularCriterioSeleccion($cita, $especie, 0));
        $cita->setCantidad(5);
        $especie->getClasificacionCriterioEsp()->setCodigo(14);
        $this->assertNotEquals('D3', CitaUtil::calcularCriterioSeleccion($cita, $especie, 0));
    }

    /**
     * @test
     */
    public function testCalcularCriterioSeleccionC1()
    {
        $classifCriteria = new ClasificacionCriterioEsp();
        $especie = new Especie();
        $especie->setClasificacionCriterioEsp($classifCriteria);

        $classifReprod = new ClaseReproduccion();
        $cita = new Cita();
        $cita->setClaseReproduccion($classifReprod);

        // Valid criteria classification
        foreach ([20, 21] as $validClasifCrit) {
            $especie->getClasificacionCriterioEsp()->setCodigo($validClasifCrit);
            $cita->setFechaAlta(new \DateTime('2016-01-01'));
            $this->assertEquals('C1', CitaUtil::calcularCriterioSeleccion($cita, $especie, 0));
            $cita->setFechaAlta(new \DateTime('2016-12-31'));
            $this->assertEquals('C1', CitaUtil::calcularCriterioSeleccion($cita, $especie, 0));
            $cita->setFechaAlta(new \DateTime('2016-11-15'));
            $this->assertEquals('C1', CitaUtil::calcularCriterioSeleccion($cita, $especie, 0));
            $cita->setFechaAlta(new \DateTime('2016-02-14'));
            $this->assertEquals('C1', CitaUtil::calcularCriterioSeleccion($cita, $especie, 0));
        }
        $cita->setFechaAlta(new \DateTime('2016-11-14'));
        $this->assertNotEquals('C1', CitaUtil::calcularCriterioSeleccion($cita, $especie, 0));
        $cita->setFechaAlta(new \DateTime('2016-02-15'));
        $this->assertNotEquals('C1', CitaUtil::calcularCriterioSeleccion($cita, $especie, 0));

        foreach ([20] as $validClasifCrit) {
            $especie->getClasificacionCriterioEsp()->setCodigo($validClasifCrit);
            $cita->setFechaAlta(new \DateTime('2016-05-15'));
            $this->assertEquals('C1', CitaUtil::calcularCriterioSeleccion($cita, $especie, 0));
            $cita->setFechaAlta(new \DateTime('2016-07-14'));
            $this->assertEquals('C1', CitaUtil::calcularCriterioSeleccion($cita, $especie, 0));
        }
        $cita->setFechaAlta(new \DateTime('2016-05-14'));
        $this->assertNotEquals('C1', CitaUtil::calcularCriterioSeleccion($cita, $especie, 0));
        $cita->setFechaAlta(new \DateTime('2016-07-15'));
        $this->assertNotEquals('C1', CitaUtil::calcularCriterioSeleccion($cita, $especie, 0));
        foreach ([22] as $validClasifCrit) {
            $especie->getClasificacionCriterioEsp()->setCodigo($validClasifCrit);
            $cita->setFechaAlta(new \DateTime('2016-03-02'));
            $this->assertEquals('C1', CitaUtil::calcularCriterioSeleccion($cita, $especie, 0));
            $cita->setFechaAlta(new \DateTime('2016-10-14'));
            $this->assertEquals('C1', CitaUtil::calcularCriterioSeleccion($cita, $especie, 0));
        }
        $cita->setFechaAlta(new \DateTime('2016-03-01'));
        $this->assertNotEquals('C1', CitaUtil::calcularCriterioSeleccion($cita, $especie, 0));
        $cita->setFechaAlta(new \DateTime('2016-10-15'));
        $this->assertNotEquals('C1', CitaUtil::calcularCriterioSeleccion($cita, $especie, 0));

        $cita->setFechaAlta(new \DateTime('2016-10-15'));
        $especie->getClasificacionCriterioEsp()->setCodigo(14);
        $this->assertNotEquals('C1', CitaUtil::calcularCriterioSeleccion($cita, $especie, 0));
    }

    /**
     * @test
     */
    public function testCalcularCriterioSeleccionC2()
    {
        $classifCriteria = new ClasificacionCriterioEsp();
        $especie = new Especie();
        $especie->setClasificacionCriterioEsp($classifCriteria);

        $classifReprod = new ClaseReproduccion();
        $cita = new Cita();
        $cita->setClaseReproduccion($classifReprod);

        // Valid criteria classification
        foreach ([20] as $validClasifCrit) {
            $especie->getClasificacionCriterioEsp()->setCodigo($validClasifCrit);
            $cita->setFechaAlta(new \DateTime('2016-02-15'));
            $this->assertEquals('C2', CitaUtil::calcularCriterioSeleccion($cita, $especie, 0));
            $cita->setFechaAlta(new \DateTime('2016-03-15'));
            $this->assertEquals('C2', CitaUtil::calcularCriterioSeleccion($cita, $especie, 0));
            $cita->setFechaAlta(new \DateTime('2016-07-15'));
            $this->assertEquals('C2', CitaUtil::calcularCriterioSeleccion($cita, $especie, 0));
            $cita->setFechaAlta(new \DateTime('2016-09-01'));
            $this->assertEquals('C2', CitaUtil::calcularCriterioSeleccion($cita, $especie, 0));
        }

        $cita->setFechaAlta(new \DateTime('2016-02-09'));
        $this->assertNotEquals('C2', CitaUtil::calcularCriterioSeleccion($cita, $especie, 0));
        $cita->setFechaAlta(new \DateTime('2016-07-14'));
        $this->assertNotEquals('C2', CitaUtil::calcularCriterioSeleccion($cita, $especie, 0));
        $cita->setFechaAlta(new \DateTime('2016-03-16'));
        $this->assertNotEquals('C2', CitaUtil::calcularCriterioSeleccion($cita, $especie, 0));
        $cita->setFechaAlta(new \DateTime('2016-02-14'));
        $this->assertNotEquals('C2', CitaUtil::calcularCriterioSeleccion($cita, $especie, 0));

        $cita->setFechaAlta(new \DateTime('2016-09-01'));
        $especie->getClasificacionCriterioEsp()->setCodigo(14);
        $this->assertNotEquals('C2', CitaUtil::calcularCriterioSeleccion($cita, $especie, 0));
    }

    /**
     * @test
     */
    public function testCalcularCriterioSeleccionC3()
    {
        $classifCriteria = new ClasificacionCriterioEsp();
        $especie = new Especie();
        $especie->setClasificacionCriterioEsp($classifCriteria);

        $classifReprod = new ClaseReproduccion();
        $cita = new Cita();
        $cita->setClaseReproduccion($classifReprod);

        // Valid criteria classification
        foreach ([21] as $validClasifCrit) {
            $especie->getClasificacionCriterioEsp()->setCodigo($validClasifCrit);
            $cita->setFechaAlta(new \DateTime('2016-02-15'));
            $this->assertEquals('C3', CitaUtil::calcularCriterioSeleccion($cita, $especie, 0));
            $cita->setFechaAlta(new \DateTime('2016-03-15'));
            $this->assertEquals('C3', CitaUtil::calcularCriterioSeleccion($cita, $especie, 0));
        }

        $cita->setFechaAlta(new \DateTime('2016-03-16'));
        $this->assertNotEquals('C3', CitaUtil::calcularCriterioSeleccion($cita, $especie, 0));
        $cita->setFechaAlta(new \DateTime('2016-02-14'));
        $this->assertNotEquals('C3', CitaUtil::calcularCriterioSeleccion($cita, $especie, 0));

        $cita->setFechaAlta(new \DateTime('2016-02-15'));
        $especie->getClasificacionCriterioEsp()->setCodigo(14);
        $this->assertNotEquals('C3', CitaUtil::calcularCriterioSeleccion($cita, $especie, 0));
    }

    /**
     * @test
     */
    public function testCalcularCriterioSeleccionC4()
    {
        $classifCriteria = new ClasificacionCriterioEsp();
        $especie = new Especie();
        $especie->setClasificacionCriterioEsp($classifCriteria);

        $classifReprod = new ClaseReproduccion();
        $cita = new Cita();
        $cita->setClaseReproduccion($classifReprod);

        // Valid criteria classification
        foreach ([22] as $validClasifCrit) {
            $especie->getClasificacionCriterioEsp()->setCodigo($validClasifCrit);
            $cita->setFechaAlta(new \DateTime('2016-10-15'));
            $this->assertEquals('C4', CitaUtil::calcularCriterioSeleccion($cita, $especie, 0));
            $cita->setFechaAlta(new \DateTime('2016-11-15'));
            $this->assertEquals('C4', CitaUtil::calcularCriterioSeleccion($cita, $especie, 0));
        }

        $cita->setFechaAlta(new \DateTime('2016-10-14'));
        $this->assertNotEquals('C4', CitaUtil::calcularCriterioSeleccion($cita, $especie, 0));
        $cita->setFechaAlta(new \DateTime('2016-11-16'));
        $this->assertNotEquals('C4', CitaUtil::calcularCriterioSeleccion($cita, $especie, 0));

        $cita->setFechaAlta(new \DateTime('2016-10-15'));
        $especie->getClasificacionCriterioEsp()->setCodigo(14);
        $this->assertNotEquals('C4', CitaUtil::calcularCriterioSeleccion($cita, $especie, 0));
    }

    /**
     * @test
     */
    public function testCalcularCriterioSeleccionC5()
    {
        $classifCriteria = new ClasificacionCriterioEsp();
        $especie = new Especie();
        $especie->setClasificacionCriterioEsp($classifCriteria);

        $classifReprod = new ClaseReproduccion();
        $cita = new Cita();
        $cita->setClaseReproduccion($classifReprod);

        // Valid criteria classification
        foreach ([20, 21] as $validClasifCrit) {
            $especie->getClasificacionCriterioEsp()->setCodigo($validClasifCrit);
            $cita->setFechaAlta(new \DateTime('2016-11-01'));
            $this->assertEquals('C5', CitaUtil::calcularCriterioSeleccion($cita, $especie, 0));
            $cita->setFechaAlta(new \DateTime('2016-11-14'));
            $this->assertEquals('C5', CitaUtil::calcularCriterioSeleccion($cita, $especie, 0));
        }

        $cita->setFechaAlta(new \DateTime('2016-10-31'));
        $this->assertNotEquals('C5', CitaUtil::calcularCriterioSeleccion($cita, $especie, 0));
        $cita->setFechaAlta(new \DateTime('2016-11-15'));
        $this->assertNotEquals('C5', CitaUtil::calcularCriterioSeleccion($cita, $especie, 0));

        foreach ([22] as $validClasifCrit) {
            $especie->getClasificacionCriterioEsp()->setCodigo($validClasifCrit);
            $cita->setFechaAlta(new \DateTime('2016-02-15'));
            $this->assertEquals('C5', CitaUtil::calcularCriterioSeleccion($cita, $especie, 0));
            $cita->setFechaAlta(new \DateTime('2016-03-01'));
            $this->assertEquals('C5', CitaUtil::calcularCriterioSeleccion($cita, $especie, 0));
        }

        $cita->setFechaAlta(new \DateTime('2016-02-14'));
        $this->assertNotEquals('C5', CitaUtil::calcularCriterioSeleccion($cita, $especie, 0));
        $cita->setFechaAlta(new \DateTime('2016-03-02'));
        $this->assertNotEquals('C5', CitaUtil::calcularCriterioSeleccion($cita, $especie, 0));

        $cita->setFechaAlta(new \DateTime('2016-10-15'));
        $especie->getClasificacionCriterioEsp()->setCodigo(14);
        $this->assertNotEquals('C5', CitaUtil::calcularCriterioSeleccion($cita, $especie, 0));
    }

    /**
     * @test
     */
    public function testCalcularCriterioSeleccionC6()
    {
        $classifCriteria = new ClasificacionCriterioEsp();
        $especie = new Especie();
        $especie->setClasificacionCriterioEsp($classifCriteria);

        $classifReprod = new ClaseReproduccion();
        $cita = new Cita();
        $cita->setClaseReproduccion($classifReprod);
        $cita->setFechaAlta(new \DateTime('2016-01-01'));

        $cita->setObservaciones('Individuos en migración');
        $this->assertEquals('C6', CitaUtil::calcularCriterioSeleccion($cita, $especie, 0));
        $cita->setObservaciones('Individuos MIGRANDO');
        $this->assertEquals('C6', CitaUtil::calcularCriterioSeleccion($cita, $especie, 0));
        $cita->setObservaciones('Individuos en migracion activa');
        $this->assertEquals('C6', CitaUtil::calcularCriterioSeleccion($cita, $especie, 0));
        $cita->setObservaciones('Sedimentacion de población constatada');
        $this->assertEquals('C6', CitaUtil::calcularCriterioSeleccion($cita, $especie, 0));

        $cita->setObservaciones('Individuos en paso');
        $this->assertNotEquals('C6', CitaUtil::calcularCriterioSeleccion($cita, $especie, 0));

        $cita->setObservaciones('Individuos en migración');
        foreach ([10, 11, 12, 13, 20, 21] as $validClasifCrit) {
            $especie->getClasificacionCriterioEsp()->setCodigo($validClasifCrit);
            $this->assertNotEquals('C6', CitaUtil::calcularCriterioSeleccion($cita, $especie, 0));
        }

        $especie->getClasificacionCriterioEsp()->setCodigo(30);
        $cita->setCantidad(5);
        $this->assertNotEquals('C6', CitaUtil::calcularCriterioSeleccion($cita, $especie, 0));

        $cita->setFechaAlta(new \DateTime('2016-10-16'));
        $especie->getClasificacionCriterioEsp()->setCodigo(22);
        $this->assertNotEquals('C6', CitaUtil::calcularCriterioSeleccion($cita, $especie, 0));
    }

    /**
     * @test
     */
    public function testCalcularCriterioSeleccionD1()
    {
        $classifCriteria = new ClasificacionCriterioEsp();
        $especie = new Especie();
        $especie->setClasificacionCriterioEsp($classifCriteria);

        $classifReprod = new ClaseReproduccion();
        $cita = new Cita();
        $cita->setClaseReproduccion($classifReprod);
        $cita->setFechaAlta(new \DateTime('2016-01-01'));

        $cita->setCantidad(31);
        $this->assertEquals('D1', CitaUtil::calcularCriterioSeleccion($cita, $especie, 0));
    }

    /**
     * @test
     */
    public function testCalcularCriterioSeleccionE2()
    {
        $classifCriteria = new ClasificacionCriterioEsp();
        $especie = new Especie();
        $especie->setClasificacionCriterioEsp($classifCriteria);

        $classifReprod = new ClaseReproduccion();
        $cita = new Cita();
        $cita->setClaseReproduccion($classifReprod);
        $cita->setFechaAlta(new \DateTime('2016-01-01'));
        $cita->getClaseReproduccion()->setCodigo('MC');
        $cita->setIndHabitatRaro(true);

        // Valid criteria classification
        foreach ([30, 40] as $validClasifCrit) {
            $especie->getClasificacionCriterioEsp()->setCodigo($validClasifCrit);
            $this->assertEquals('E2', CitaUtil::calcularCriterioSeleccion($cita, $especie, 0));
        }
        // Valid reproduction classification
        foreach (['MC', 'PP', 'PN', 'CN', 'DD', 'NV', 'JO', 'CB', 'NI'] as $validClasifReprod) {
            $cita->getClaseReproduccion()->setCodigo($validClasifReprod);
            $this->assertEquals('E2', CitaUtil::calcularCriterioSeleccion($cita, $especie, 0));
        }
        // Invalid reproduction classification
        foreach (['SP', 'NA', 'NC'] as $invalidClasifReprod) {
            $cita->getClaseReproduccion()->setCodigo($invalidClasifReprod);
            $this->assertNotEquals('E2', CitaUtil::calcularCriterioSeleccion($cita, $especie, 0));
        }
    }

    /**
     * @test
     */
    public function testCalcularCriterioSeleccionF1()
    {
        $classifCriteria = new ClasificacionCriterioEsp();
        $especie = new Especie();
        $especie->setClasificacionCriterioEsp($classifCriteria);

        $classifReprod = new ClaseReproduccion();
        $cita = new Cita();
        $cita->setClaseReproduccion($classifReprod);
        $cita->setFechaAlta(new \DateTime('2016-01-01'));
        $cita->setIndComportamiento(true);

        // Valid criteria classification
        foreach ([30, 40] as $validClasifCrit) {
            $especie->getClasificacionCriterioEsp()->setCodigo($validClasifCrit);
            $this->assertEquals('F1', CitaUtil::calcularCriterioSeleccion($cita, $especie, 0));
        }
    }

    /**
     * @test
     */
    public function testCalcularCriterioSeleccionG2()
    {
        $classifCriteria = new ClasificacionCriterioEsp();
        $especie = new Especie();
        $especie->setClasificacionCriterioEsp($classifCriteria);

        $classifReprod = new ClaseReproduccion();
        $cita = new Cita();
        $cita->setClaseReproduccion($classifReprod);
        $cita->setFechaAlta(new \DateTime('2016-01-01'));

        $cita->setIndHerido(true);
        $this->assertEquals('G2', CitaUtil::calcularCriterioSeleccion($cita, $especie, 0));

        $cita->setIndHerido(false);
        $cita->setObservaciones('Individuo muerto');
        $this->assertEquals('G2', CitaUtil::calcularCriterioSeleccion($cita, $especie, 0));
        $cita->setObservaciones('Individuo herido');
        $this->assertEquals('G2', CitaUtil::calcularCriterioSeleccion($cita, $especie, 0));
        $cita->setObservaciones('Individuo acciDENtado');
        $this->assertEquals('G2', CitaUtil::calcularCriterioSeleccion($cita, $especie, 0));
        $cita->setObservaciones('Rapaz muerta bajo un poste eléctrico');
        $this->assertEquals('G2', CitaUtil::calcularCriterioSeleccion($cita, $especie, 0));
    }

    /**
     * @test
     */
    public function testCalcularCriterioSeleccionD2()
    {
        $classifCriteria = new ClasificacionCriterioEsp();
        $especie = new Especie();
        $especie->setClasificacionCriterioEsp($classifCriteria);

        $classifReprod = new ClaseReproduccion();
        $cita = new Cita();
        $cita->setClaseReproduccion($classifReprod);
        $cita->setFechaAlta(new \DateTime('2016-01-01'));

        $cita->setIndHerido(false);
        $cita->setObservaciones('Durante censo de aves acuáticas');
        $this->assertEquals('D2', CitaUtil::calcularCriterioSeleccion($cita, $especie, 0));
        $cita->setObservaciones('Durante anillamiento en Los Nuevos');
        $this->assertEquals('D2', CitaUtil::calcularCriterioSeleccion($cita, $especie, 0));
        $cita->setObservaciones('Individuo anillado');
        $this->assertEquals('D2', CitaUtil::calcularCriterioSeleccion($cita, $especie, 0));
        $cita->setObservaciones('Hembra anillada en la pata izquierda');
        $this->assertEquals('D2', CitaUtil::calcularCriterioSeleccion($cita, $especie, 0));
        $cita->setObservaciones('Individuo con anilla en la pata derecha');
        $this->assertEquals('D2', CitaUtil::calcularCriterioSeleccion($cita, $especie, 0));
    }

    /**
     * @test
     */
    public function testCalcularCriterioSeleccionA2()
    {
        $classifCriteria = new ClasificacionCriterioEsp();
        $especie = new Especie();
        $especie->setClasificacionCriterioEsp($classifCriteria);

        $classifReprod = new ClaseReproduccion();
        $cita = new Cita();
        $cita->setClaseReproduccion($classifReprod);
        $cita->setFechaAlta(new \DateTime('2016-01-01'));

        $this->assertEquals('A2', CitaUtil::calcularCriterioSeleccion($cita, $especie, 51));
        $this->assertNotEquals('A2', CitaUtil::calcularCriterioSeleccion($cita, $especie, 50));
    }
}
