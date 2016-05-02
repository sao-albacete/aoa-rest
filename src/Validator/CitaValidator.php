<?php
namespace Aoa\Validator;

use Aoa\Util\RegexUtil;
use Valitron\Validator;

/**
 * Class CitaValidator
 * @author viktorKhan
 * @link https://github.com/viktorKhan
 */
class CitaValidator extends Validator
{
    public function __construct(array $data, $fields = array(), $lang = null, $langDir = null)
    {
        parent::__construct($data, $fields, $lang, $langDir);
    }

    public function validate()
    {
        $today = new \DateTime();
        $yesterday = $today->sub(new \DateInterval('P1D'));
        // Required files
        $this->rule(
            'required',
            [
                'fechaAlta',
                'cantidad',
                'lugar_codigo',
                'observador_principal_codigo',
                'clase_reproduccion_id',
                'especie_code',
                'criterio_seleccion_cita_id',
                'claseEdadSexo',
            ]
        );
        // Date fields
        $this->rule('date', ['fechaAlta']);
        $this->rule('dateAfter', 'fechaAlta', $yesterday);
        // Number fields
        $this->rule('min', 'cantidad', 1);
        $this->rule(
            'numeric',
            [
                'clase_reproduccion_id',
                'especie_code',
                'criterio_seleccion_cita_id',
            ]
        );
        // Text fields
        $this->rule('slug', ['lugar_codigo']);
        $this->rule('alphaNum', ['observador_principal_codigo', 'estudio_codigo', 'fuente_codigo']);
        $this->rule('length', 'lugar_codigo', 0, 36);
        $this->rule('regex', 'lugar_codigo', RegexUtil::MATCH_UUID);
        $this->rule('lengthBetween', 'observador_principal_codigo', 2, 3);
        $this->rule('lengthBetween', 'estudio_codigo', 2, 10);
        $this->rule('lengthBetween', 'fuente_codigo', 2, 10);
        $this->rule('lengthBetween', 'observaciones', 0, 1000);
        // Array fields
        $this->rule('array', ['colaboradores', 'claseEdadSexo']);
        // TODO Booleans
//        $this->rule('boolean', ['indHabitatRaro', 'indCriaHabitatRaro', 'indHerido', 'indComportamiento', 'indFoto']);

        return parent::validate();
    }
}
