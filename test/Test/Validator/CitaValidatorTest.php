<?php
namespace Aoa\Test\Validator;

use Aoa\Validator\CitaValidator;

/**
 * Class CitaValidatorTest
 * @author viktorKhan
 * @link https://github.com/viktorKhan
 */
class CitaValidatorTest extends \PHPUnit_Framework_TestCase
{
    public function testValidateOkRequired()
    {
        $citaArray = [
            'fechaAlta' => (new \DateTime())->format('Y-m-d'),
            'cantidad' => 1,
            'lugar_id' => 2,
            'observador_principal_id' => 3,
            'clase_reproduccion_id' => 4,
            'especie_id' => 5,
            'criterio_seleccion_cita_id' => 6,
        ];
        $validator = new CitaValidator($citaArray);

        $this->assertTrue($validator->validate());
    }

    public function testValidateEmpty()
    {
        $citaArray = [];
        $validator = new CitaValidator($citaArray);

        $this->assertFalse($validator->validate());
    }
}
