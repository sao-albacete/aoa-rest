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
        return [
            'id' => $cita->getId(),
        ];
    }
}
