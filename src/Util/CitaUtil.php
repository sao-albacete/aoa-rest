<?php
namespace Aoa\Util;
use Aoa\Entity\Cita;
use Aoa\Entity\Especie;

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
        $selectionCriteria = 21;

        $criteriaClassification = $especie->getClasificacionCriterioEsp();
        $reproductionClassification = $cita->getClaseReproduccion();
        $amount = $cita->getCantidad();
        $observations = $cita->getObservaciones();

        $indHabitatAtipico = 0;
        if (isset($cita['indHabitatRaro'])) {
            $indHabitatAtipico = $cita['indHabitatRaro'];
        }

        $indComportamientoCurioso = 0;
        if (isset($cita['indComportamiento'])) {
            $indComportamientoCurioso = $cita['indComportamiento'];
        }

        $indHerido = 0;
        if (isset($cita['indHerido'])) {
            $indHerido = $cita['indHerido'];
        }

        $fechaArray = explode("-", $cita['fechaAlta']);
        $mes = intval($fechaArray[1]);
        $dia = intval($fechaArray[2]);

        /*
         * Citas de presencia
         * De rarezas, escasas o poco conocidas en la provincia
         */
        // A1
        if ($criteriaClassification == 1 || $criteriaClassification == 3 || $criteriaClassification == 4) {
            $selectionCriteria = 1;
        }

        /*
         * Citas de conservación
         * Todas las citas de especies incluidas en el Catálogo Regional de Especies Amenazadas, en las categorías de "En Peligro" y "Vulnerables".
         */
        // G1
        elseif ($criteriaClassification == 2) {
            $selectionCriteria = 19;
        }

        /*
         * Citas de reproducción
         * Datos de cría posible, probable y confirmada de especies que no sean abundantes.
         */
        // E1
        elseif (($criteriaClassification == 3 || $criteriaClassification == 4 || $criteriaClassification == 5) && ($reproductionClassification >= 2 && $reproductionClassification <= 10)) {
            $selectionCriteria = 14;
        }

        /*
         * Citas de abundancia
         * De especies escasas en la provincia, zona, biotopo, etc.
         */
        // D3
        elseif ($criteriaClassification == 9 && $amount > 4) {
            $selectionCriteria = 13;
        }

        /*
         * Citas de fenología
         * De aves en épocas anormales para la especie.
         */
        // C1
        elseif ((($criteriaClassification == 6 ) && ((($mes == 12) || ($mes == 1) || ($mes == 2) || ($mes == 11 && $dia >= 15) || ($mes == 3 && $dia == 1)) || (($mes == 6) || ($mes == 5 && $dia >= 15) || ($mes == 7 && $dia <= 15))))
            || (($criteriaClassification == 7 ) && (($mes == 12) || ($mes == 1) || ($mes == 2) || ($mes == 11 && $dia >= 15) || ($mes == 3 && $dia == 1)))
            || (($criteriaClassification == 8 ) && (($mes >= 3 && $mes <= 9) || ($mes == 10 && $dia <= 15)))) {
            $selectionCriteria = 5;
        }

        /*
         * Citas de fenología
         * Primeras observations en especies en paso migratorio prenupcial (primera observación prenupcial) o en paso posnupcial (primera observación posnupcial).
         */
        // C2
        elseif (($criteriaClassification == 6) && (($mes == 2 && $dia >= 15) || ($mes == 3 && $dia <= 15) || ($mes == 8) || ($mes == 7 && $dia >= 15) || ($mes == 9 && $dia == 1))) {
            $selectionCriteria = 6;
        }

        /*
         * Citas de fenología
         * Primeras observations de especies estivales. Es preciso poner cuidado en distinguir estas aves nativas de otros individuos de la misma especie que pueden pasar por la localidad de observación pero no quedarse a criar en ella.En caso de duda se anota como primera observación.
         */
        // C3
        elseif (($criteriaClassification == 7) && (($mes == 2 && $dia >= 15) || ($mes == 3 && $dia <= 15))) {
            $selectionCriteria = 7;
        }

        /*
         * Citas de fenología
         * Primeros invernantes vistos en una localidad determinada.
         */
        // C4
        elseif (($criteriaClassification == 8) && (($mes == 10 && $dia >= 15) || ($mes == 11 && $dia <= 15))) {
            $selectionCriteria = 8;
        }

        /*
         * Citas de fenología
         * De aves vistas en últimas observations tanto en migrantes, como en estivales e invernantes.
         */
        // C5
        elseif ((($criteriaClassification == 6 || $criteriaClassification == 7) && ($mes == 11 && $dia <= 15))
            || (($criteriaClassification == 8) && (($mes == 2 && $dia >= 15) || ($mes == 3 && $dia == 1)))) {
            $selectionCriteria = 9;
        }

        /*
         * Citas de fenología
         * De aves vistas en migración activa o sedimentadas fuera de un hábitat típico.
         */
        // C6
        elseif (strpos($observations,'migracion') || strpos($observations,'sedimentacion') || strpos($observations,'activa') || strpos($observations,'migrando')) {
            $selectionCriteria = 10;
        }

        /*
         * Citas de abundancia
         * De concentraciones anormales o sobresalientes de una especie, por el elevado o bajo número de aves.
         */
        // D1
        elseif ($amount > 30) {
            $selectionCriteria = 11;
        }

        /*
         * Citas de reproducción
         * Datos de nidificación de especies abundantes, pero fuera de su hábitat típico.
         */
        // E2
        elseif (($criteriaClassification == 9 || $criteriaClassification == 10) && ($reproductionClassification >= 2 && $reproductionClassification <= 10) && $indHabitatAtipico) {
            $selectionCriteria = 15;
        }

        /*
         * Citas de comportamiento
         * Extraños o curiosos, de cualquier ave.
         */
        // F1
        elseif (($criteriaClassification == 9 || $criteriaClassification == 10) && $indComportamientoCurioso) {
            $selectionCriteria = 17;
        }

        /*
         * Citas de conservación
         * Citas de aves encontradas muertas o heridas, por cualquier causa.
         */
        // G2
        elseif ($indHerido) {
            $selectionCriteria = 20;
        }

        /*
         * Citas de abundancia
         * De conteos en censos y jornadas de anillamiento.
         */
        // D2
        elseif (strpos($observations,'censo') || strpos($observations,'anillamiento') || strpos($observations,'anillado') || strpos($observations,'anillada')) {
            $selectionCriteria = 12;
        }

        /*
         * Citas de distribución
         * En localidades o zonas de la geografía provincial poco prospectadas o con escasos datos.
         */
        // A2
        elseif ($numeroCitasPorLugar > 50) {
            $selectionCriteria = 2;
        }

        return $selectionCriteria;
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
