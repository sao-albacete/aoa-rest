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
            $cita->setFechaAlta(new \DateTime('2016-03-01'));
            $this->assertEquals('C1', CitaUtil::calcularCriterioSeleccion($cita, $especie, 0));
            $cita->setFechaAlta(new \DateTime('2016-10-14'));
            $this->assertEquals('C1', CitaUtil::calcularCriterioSeleccion($cita, $especie, 0));
        }
        $cita->setFechaAlta(new \DateTime('2016-02-27'));
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
            $cita->setFechaAlta(new \DateTime('2016-11-15'));
            $this->assertEquals('C5', CitaUtil::calcularCriterioSeleccion($cita, $especie, 0));
        }

        $cita->setFechaAlta(new \DateTime('2016-10-31'));
        $this->assertNotEquals('C5', CitaUtil::calcularCriterioSeleccion($cita, $especie, 0));
        $cita->setFechaAlta(new \DateTime('2016-11-16'));
        $this->assertNotEquals('C5', CitaUtil::calcularCriterioSeleccion($cita, $especie, 0));

        foreach ([22] as $validClasifCrit) {
            $especie->getClasificacionCriterioEsp()->setCodigo($validClasifCrit);
            $cita->setFechaAlta(new \DateTime('2016-02-15'));
            $this->assertEquals('C5', CitaUtil::calcularCriterioSeleccion($cita, $especie, 0));
            $cita->setFechaAlta(new \DateTime('2016-03-01'));
            $this->assertEquals('C5', CitaUtil::calcularCriterioSeleccion($cita, $especie, 0));
        }

        $cita->setFechaAlta(new \DateTime('2016-02-16'));
        $this->assertNotEquals('C5', CitaUtil::calcularCriterioSeleccion($cita, $especie, 0));
        $cita->setFechaAlta(new \DateTime('2016-03-02'));
        $this->assertNotEquals('C5', CitaUtil::calcularCriterioSeleccion($cita, $especie, 0));

        $cita->setFechaAlta(new \DateTime('2016-10-15'));
        $especie->getClasificacionCriterioEsp()->setCodigo(14);
        $this->assertNotEquals('C5', CitaUtil::calcularCriterioSeleccion($cita, $especie, 0));
    }
}
