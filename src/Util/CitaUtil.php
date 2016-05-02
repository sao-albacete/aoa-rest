<?php
namespace Aoa\Util;
use Aoa\Date\DatePeriod;
use Aoa\Entity\Cita;
use Aoa\Entity\Especie;
use Cocur\Slugify\Slugify;

/**
 * Class CitaUtil
 * @author viktorKhan
 * @link https://github.com/viktorKhan
 */
class CitaUtil
{
    /**
     * Calculate record importance
     *
     * @param $indRareza
     * @param $claseCriterio
     * @param $claseReproduccion
     * @return int
     */
    public static function calculateRecordImportance($indRareza, $claseCriterio, $claseReproduccion)
    {
        // By default, ND - No destacado
        $recordImportance = 13;

        // R - Rareza nacional
        if ($indRareza == 1) {
            $recordImportance = 1;
        }
        // r - Rareza local
        if ($indRareza == 2) {
            $recordImportance = 2;
        }
        // EP - Especie protegida EN o VU
        if ($claseCriterio == 2) {
            $recordImportance = 3;
        }
        // E - Especie muy escasa
        if ($claseCriterio == 3 || $claseCriterio == 4) {
            $recordImportance = 4;
        }
        // R? - Rareza nacional con cría probable
        if ($indRareza == 1 && ($claseReproduccion >= 2 && $claseReproduccion <= 5)) {
            $recordImportance = 5;
        }
        // r? - Rareza local con cría probable
        if ($indRareza == 2 && ($claseReproduccion >= 2 && $claseReproduccion <= 5)) {
            $recordImportance = 6;
        }
        // EP? - Esp. Protegida con cría probable
        if ($claseCriterio == 2 && ($claseReproduccion >= 2 && $claseReproduccion <= 5)) {
            $recordImportance = 7;
        }
        // E? - Especie escasa con cría probable
        if (($claseCriterio == 3 || $claseCriterio == 4) && ($claseReproduccion >= 2 && $claseReproduccion <= 5)) {
            $recordImportance = 8;
        }
        // R¡ - Rareza nacional con cría segura
        if ($indRareza == 1 && ($claseReproduccion >= 6 && $claseReproduccion <= 10)) {
            $recordImportance = 9;
        }
        // r¡ - Rareza local con cría segura
        if ($indRareza == 2 && ($claseReproduccion >= 6 && $claseReproduccion <= 10)) {
            $recordImportance = 10;
        }
        // EP¡ - Esp. Protegida con cría segura
        if ($claseCriterio == 2 && ($claseReproduccion >= 6 && $claseReproduccion <= 10)) {
            $recordImportance = 11;
        }
        // E¡ - Especie escasa con cría segura
        if (($claseCriterio == 3 || $claseCriterio == 4) && ($claseReproduccion >= 6 && $claseReproduccion <= 10)) {
            $recordImportance = 12;
        }

        return $recordImportance;
    }

    /**
     * Calculate the selection criteria of a record
     *
     * @param Cita $cita
     * @param Especie $especie
     * @param Number $numeroCitasPorLugar
     * @return int
     */
    public static function calcularCriterioSeleccion(Cita $cita, Especie $especie, $numeroCitasPorLugar)
    {
        // Species data
        $critClassif = $especie->getClasificacionCriterioEsp()->getCodigo();
        // Record data
        $reprodClassif = $cita->getClaseReproduccion()->getCodigo();
        $amount = $cita->getCantidad();
        $observations = (new Slugify())->slugify($cita->getObservaciones(), ' ');
        $indHabitatAtipico = $cita->getIndHabitatRaro();
        $indComportamientoCurioso = $cita->getIndComportamiento();
        $indHerido = $cita->getIndHerido();
        $date = $cita->getFechaAlta();
        $year = $date->format('Y');

        $cria = ['MC', 'PP', 'PN', 'CN', 'DD', 'NV', 'JO', 'CB', 'NI'];

        /*
         * Citas de reproducción
         * Datos de cría posible, probable y confirmada de especies que no sean abundantes.
         */
        if (in_array($critClassif, [12, 13, 14]) && in_array($reprodClassif, $cria)) {
            return 'E1';
        }
        /*
         * Citas de presencia
         * De rarezas, escasas o poco conocidas en la provincia
         */
        if (in_array($critClassif, [10, 12, 13])) {
            return 'A1';
        }
        /*
         * Citas de conservación
         * Todas las citas de especies incluidas en el Catálogo Regional de Especies Amenazadas,
         * en las categorías de "En Peligro" y "Vulnerables".
         */
        if (in_array($critClassif, [11])) {
            return 'G1';
        }
        /*
         * Citas de abundancia
         * De especies escasas en la provincia, zona, biotopo, etc.
         */
        if (in_array($critClassif, [30]) && $amount > 4) {
            return 'D3';
        }
        /*
         * Citas de fenología
         * De aves en épocas anormales para la especie.
         */
        if (in_array($critClassif, [20, 21]) && (
                (new DatePeriod(15, 11, 31, 12, $year))->inPeriod($date) ||
                (new DatePeriod(1, 1, 14, 2, $year))->inPeriod($date)
            ) || in_array($critClassif, [20]) && (
                (new DatePeriod(15, 5, 14, 7, $year))->inPeriod($date)
            ) || in_array($critClassif, [22]) && (
                (new DatePeriod(1, 3, 14, 10, $year))->inPeriod($date)
            )) {
            return 'C1';
        }
        /*
         * Citas de fenología
         * Primeras observations en especies en paso migratorio prenupcial (primera observación prenupcial) o
         * en paso posnupcial (primera observación posnupcial).
         */
        if (in_array($critClassif, [20]) && (
                (new DatePeriod(15, 2, 15, 3, $year))->inPeriod($date) ||
                (new DatePeriod(15, 7, 1, 9, $year))->inPeriod($date)
            )) {
            return 'C2';
        }
        /*
         * Citas de fenología
         * Primeras observations de especies estivales. Es preciso poner cuidado en distinguir estas aves nativas de
         * otros individuos de la misma especie que pueden pasar por la localidad de observación pero no quedarse a
         * criar en ella.En caso de duda se anota como primera observación.
         */
        if (in_array($critClassif, [21]) &&  (new DatePeriod(15, 2, 15, 3, $year))->inPeriod($date)) {
            return 'C3';
        }
        /*
         * Citas de fenología
         * Primeros invernantes vistos en una localidad determinada.
         */
        if (in_array($critClassif, [22]) && (new DatePeriod(15, 10, 15, 11, $year))->inPeriod($date)) {
            return 'C4';
        }
        /*
         * Citas de fenología
         * De aves vistas en últimas observations tanto en migrantes, como en estivales e invernantes.
         */
        if (in_array($critClassif, [20, 21]) && (
                (new DatePeriod(1, 11, 15, 11, $year))->inPeriod($date)
            ) || in_array($critClassif, [22]) && (
                (new DatePeriod(15, 2, 1, 3, $year))->inPeriod($date)
            )) {
            return 'C5';
        }
        /*
         * Citas de fenología
         * De aves vistas en migración activa o sedimentadas fuera de un hábitat típico.
         */
        if (preg_match('[migracion|sedimentacion|activa|migrando]', $observations)) {
            return 'C6';
        }
        /*
         * Citas de abundancia
         * De concentraciones anormales o sobresalientes de una especie, por el elevado o bajo número de aves.
         */
        if ($amount > 30) {
            return 'D1';
        }
        /*
         * Citas de reproducción
         * Datos de nidificación de especies abundantes, pero fuera de su hábitat típico.
         */
        if (in_array($critClassif, [30, 40]) && in_array($reprodClassif, $cria) && $indHabitatAtipico) {
            return 'E2';
        }
        /*
         * Citas de comportamiento
         * Extraños o curiosos, de cualquier ave.
         */
        if (in_array($critClassif, [30, 40]) && $indComportamientoCurioso) {
            return 'F1';
        }
        /*
         * Citas de conservación
         * Citas de aves encontradas muertas o heridas, por cualquier causa.
         */
        if ($indHerido || preg_match('[muerto|herido|accidentado|muerta|herida|accidentada]', $observations)) {
            return 'G2';
        }
        /*
         * Citas de abundancia
         * De conteos en censos y jornadas de anillamiento.
         */
        if (preg_match('[censo|anillamiento|anillado|anillada]', $observations)) {
            return 'D2';
        }
        /*
         * Citas de distribución
         * En localidades o zonas de la geografía provincial poco prospectadas o con escasos datos.
         */
        if ($numeroCitasPorLugar > 50) {
            return 'A2';
        }

        return '';
    }

    /**
     * Calcula el grado de privacidad de la cita
     *
     * @param $citaId
     * @param $citaFechaAlta
     * @param $especieId
     * @param $claseReproduccionId
     * @return int
     */
    public static function calculateRecordPrivacy($citaId, $citaFechaAlta, $especieId, $claseReproduccionId)
    {
        $privacidad = 1;

//        $criteriosPrivacidad = $this->AsoEspeciePrivacidad->obtenerCriteriosPrivacidadPorIdEspecie($especieId);
//
//        if (! empty($criteriosPrivacidad)) {
//
//            for ($i = 0; $i < count($criteriosPrivacidad); $i ++) {
//
//                $criterioPrivacidad = $criteriosPrivacidad[$i]['AsoEspeciePrivacidad']['id_privacidad_id'];
//
//                // Cualquier sexo o edad o periodo del 1 de enero al 31 de diciembre
//                if ($criterioPrivacidad == Constants::PRIVACIDAD_CUALQUIER_SEXO_EDAD || $criterioPrivacidad == Constants::PRIVACIDAD_PERIODO_1ENERO_31DICIEMBRE) {
//                    $privacidad = 0;
//                    break;
//                }                    // Comportamiento reproductivo
//                elseif ($criterioPrivacidad == Constants::PRIVACIDAD_COMPORTAMIENTO_REPRODUCTIVO) {
//                    if ($claseReproduccionId >= 2 && $claseReproduccionId <= 10) {
//                        $privacidad = 0;
//                        break;
//                    }
//                }                    // Periodo
//                elseif ($criterioPrivacidad >= 1 && $criterioPrivacidad <= 11) {
//
//                    $fechaArray = explode("-", $citaFechaAlta);
//                    $mes = (int) $fechaArray[1];
//
//                    // Periodo del 1 de abril al 31 de agosto
//                    if ($criterioPrivacidad == Constants::PRIVACIDAD_PERIODO_1ABRIL_31AGOSTO) {
//                        if ($mes >= Constants::ABRIL && $mes <= Constants::AGOSTO) {
//                            $privacidad = 0;
//                            break;
//                        }
//                    }                        // Periodo del 1 de abril al 31 de julio
//                    elseif ($criterioPrivacidad == Constants::PRIVACIDAD_PERIODO_1ABRIL_31JULIO) {
//                        if ($mes >= Constants::ABRIL && $mes <= Constants::JULIO) {
//                            $privacidad = 0;
//                            break;
//                        }
//                    }                        // Periodo del 1 de enero al 31 de julio
//                    elseif ($criterioPrivacidad == Constants::PRIVACIDAD_PERIODO_1ENERO_31JULIO) {
//                        if ($mes >= Constants::ENERO && $mes <= Constants::JULIO) {
//                            $privacidad = 0;
//                            break;
//                        }
//                    }                        // Periodo del 1 de febrero al 31 de julio
//                    elseif ($criterioPrivacidad == Constants::PRIVACIDAD_PERIODO_1FEBRERO_31JULIO) {
//                        if ($mes >= Constants::FEBRERO && $mes <= Constants::JULIO) {
//                            $privacidad = 0;
//                            break;
//                        }
//                    }                        // Periodo del 1 de marzo al 30 de junio
//                    elseif ($criterioPrivacidad == Constants::PRIVACIDAD_PERIODO_1MARZO_30JUNIO) {
//                        if ($mes >= Constants::MARZO && $mes <= Constants::JUNIO) {
//                            $privacidad = 0;
//                            break;
//                        }
//                    }                        // Periodo del 1 de marzo al 31 de agosto
//                    elseif ($criterioPrivacidad == Constants::PRIVACIDAD_PERIODO_1MARZO_31AGOSTO) {
//                        if ($mes >= Constants::MARZO && $mes <= Constants::AGOSTO) {
//                            $privacidad = 0;
//                            break;
//                        }
//                    }                        // Periodo del 1 de marzo al 31 de julio
//                    elseif ($criterioPrivacidad == Constants::PRIVACIDAD_PERIODO_1MARZO_31JULIO) {
//                        if ($mes >= Constants::MARZO && $mes <= Constants::JULIO) {
//                            $privacidad = 0;
//                            break;
//                        }
//                    }                        // Periodo del 1 de mayo al 31 de agosto
//                    elseif ($criterioPrivacidad == Constants::PRIVACIDAD_PERIODO_1MAYO_31AGOSTO) {
//                        if ($mes >= Constants::MAYO && $mes <= Constants::AGOSTO) {
//                            $privacidad = 0;
//                            break;
//                        }
//                    }                        // Periodo del 1 de mayo al 31 de julio
//                    elseif ($criterioPrivacidad == Constants::PRIVACIDAD_PERIODO_1MAYO_31JULIO) {
//                        if ($mes >= Constants::MAYO && $mes <= Constants::JULIO) {
//                            $privacidad = 0;
//                            break;
//                        }
//                    }
//                } elseif ($criterioPrivacidad >= 13 && $criterioPrivacidad <= 15) {
//
//                    // Edad adulta de cualquier sexo
//                    if ($criterioPrivacidad == Constants::PRIVACIDAD_EDAD_ADULTA_CUALQUIER_SEXO) {
//                        if ($this->AsoCitaClaseEdadSexo->existenCitasAdultos($citaId, $especieId)) {
//                            $privacidad = 0;
//                            break;
//                        }
//                    }                        // Sexo hembra de cualquier edad
//                    elseif ($criterioPrivacidad == Constants::PRIVACIDAD_SEXO_HEMBRA_CUALQUIER_EDAD) {
//                        if ($this->AsoCitaClaseEdadSexo->existenCitasHembras($citaId)) {
//                            $privacidad = 0;
//                            break;
//                        }
//                    }                        // Sexo macho de cualquier edad
//                    elseif ($criterioPrivacidad == Constants::PRIVACIDAD_SEXO_MACHO_CUALQUIER_EDAD) {
//                        if ($this->AsoCitaClaseEdadSexo->existenCitasMachos($citaId)) {
//                            $privacidad = 0;
//                            break;
//                        }
//                    }
//                }
//            }
//        }

        return $privacidad;
    }
}
