<?php 
namespace App\Classe;

use App\Entity\Category;
use App\Entity\Brand;

class Search
{
    /**
     * @var string
     */
    public $stringSearch = '';

    /**
     * @var Category[]
     */
    public $categoryVOs = [];

        /**
     * @var SubCategory[]
     */
    public $subCategoryVOs = [];

    /**
     * @var Brand[]
     */
    public $brandVOs = [];




}
?>