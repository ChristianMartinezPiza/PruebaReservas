<?php

namespace App\Entity;

use App\Repository\ReservasRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ReservasRepository::class)
 */
class Reservas
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer", unique=true)
     */
    private $localizador;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $huesped;

    /**
     * @ORM\Column(type="date")
     */
    private $entrada;

    /**
     * @ORM\Column(type="date")
     */
    private $salida;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $hotel;

    /**
     * @ORM\Column(type="float")
     */
    private $precio;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $acciones;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLocalizador(): ?int
    {
        return $this->localizador;
    }

    public function setLocalizador(int $localizador): self
    {
        $this->localizador = $localizador;

        return $this;
    }

    public function getHuesped(): ?string
    {
        return $this->huesped;
    }

    public function setHuesped(string $huesped): self
    {
        $this->huesped = $huesped;

        return $this;
    }

    public function getEntrada(): ?string
    {
        return $this->entrada;
    }

    public function setEntrada(string $entrada): self
    {
        $this->entrada = $entrada;

        return $this;
    }

    public function getSalida(): ?string
    {
        return $this->salida;
    }

    public function setSalida(string $salida): self
    {
        $this->salida = $salida;

        return $this;
    }

    public function getHotel(): ?string
    {
        return $this->hotel;
    }

    public function setHotel(string $hotel): self
    {
        $this->hotel = $hotel;

        return $this;
    }

    public function getPrecio(): ?float
    {
        return $this->precio;
    }

    public function setPrecio(float $precio): self
    {
        $this->precio = $precio;

        return $this;
    }

    public function getAcciones(): ?string
    {
        return $this->acciones;
    }

    public function setAcciones(string $acciones): self
    {
        $this->acciones = $acciones;

        return $this;
    }

    public function actualizarReservas(){
        $fila=0;
        $reservas = array();
        $archivo=fopen("http://tech-test.wamdev.net/", "r");
            while(($registro = fgetcsv($archivo, 1000, ";")) !== false){
                $num = count($registro);
                for($columna = 0; $columna<$num; $columna++){
                    $datos[$columna] = $registro[$columna];
                }
                if (count($datos)>2) {
                    $reserva = new Reservas();
                    $reserva->setLocalizador(intval($datos[0]));
                    $reserva->setHuesped($datos[1]);
                    $reserva->setEntrada($datos[2]);
                    $reserva->setSalida($datos[3]);
                    $reserva->setHotel($datos[4]);
                    $reserva->setPrecio(floatval($datos[5]));
                    $reserva->setAcciones($datos[6]);
                    array_push($reservas, $reserva);
                }
                $fila++;
            }
        fclose($archivo);
            return $reservas;
        }
}
