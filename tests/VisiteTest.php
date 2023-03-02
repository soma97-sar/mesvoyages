<?php

/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/PHPClass.php to edit this template
 */

namespace App\Tests;

use App\Entity\Visite;
use DateTime;
use PHPUnit\Framework\TestCase;

/**
 * Description of VisiteTest
 *
 * @author BEN BAHA
 */
class VisiteTest extends TestCase {
    public function testGetDatecreationString() {
        $visite = new Visite();
        $visite->setDatecreation(new DateTime("2022-04-14"));
        $this->assertEquals("14/04/22", $visite->getDatecreationString());   
    }
    
    
   
}
