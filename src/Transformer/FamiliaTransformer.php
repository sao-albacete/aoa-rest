<?php
/**
 * Created by aoa-rest.
 * User: viktorKhan
 * Date: 16/03/16
 * Time: 0:12
 */
namespace Aoa\Transformer;

use Aoa\Entity\Familia;
use League\Fractal\TransformerAbstract;

/**
 * Class FamiliaTransformer
 * @author Wonnova
 * @link http://www.wonnova.com
 */
class FamiliaTransformer extends TransformerAbstract
{
    public function transform (Familia $familia)
    {
        return [
            'nombre' => $familia->getNombre(),
            'ordenTaxonomico' => $familia->getOrdenTaxonomico()->getNombre()
        ];
    }
}
