<?php
namespace App\Tests;

use App\Entity\Reservas;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use function PHPUnit\Framework\greaterThan;

class reservasTest extends WebTestCase
{
    public function testSomething(): void
    {
        $client = static::createClient();

        $client->request('GET', '/');

        $reservas = new Reservas();
        $reservasArray = $reservas->actualizarReservas();
        $reservasJson = json_encode($reservasArray);
        file_put_contents('public/reservas.json', $reservasJson);
        $this->assertGreaterThan(2, $reservasArray);
        $this->assertFileExists('public/reservas.json');
    }
}
