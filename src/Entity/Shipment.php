<?php

namespace App\Entity;

use App\Repository\ShipmentRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ShipmentRepository::class)]
class Shipment
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'shipments')]
    private ?Company $company = null;

    #[ORM\ManyToOne(inversedBy: 'shipments')]
    private ?Consigne $consigne = null;

    #[ORM\ManyToOne(inversedBy: 'shipments')]
    private ?DeliveryLocation $deliveryLocation = null;

    #[ORM\ManyToOne(inversedBy: 'shipments')]
    private ?LoadingLocations $loadingLocation = null;

    #[ORM\Column]
    private ?int $sealNumber = null;

    #[ORM\Column]
    private ?int $quantity = null;

    #[ORM\Column(length: 255)]
    private ?string $tourNumber = null;

    #[ORM\Column(type: Types::TIME_IMMUTABLE)]
    private ?\DateTimeImmutable $arrivalTime = null;

    #[ORM\Column(type: Types::TIME_IMMUTABLE)]
    private ?\DateTimeImmutable $departureTime = null;

    #[ORM\Column(length: 255)]
    private ?string $trailerPlate = null;

    #[ORM\Column(length: 255)]
    private ?string $tractorPlate = null;

    #[ORM\ManyToOne(inversedBy: 'shipments')]
    private ?Transporteur $transporteur = null;

    #[ORM\ManyToOne(inversedBy: 'shipments')]
    private ?TypeLoading $typeLoading = null;

    #[ORM\Column]
    private ?int $numberReference = null;

    #[ORM\Column]
    private ?int $nombrePalette = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCompany(): ?Company
    {
        return $this->company;
    }

    public function setCompany(?Company $company): static
    {
        $this->company = $company;

        return $this;
    }

    public function getConsigne(): ?Consigne
    {
        return $this->consigne;
    }

    public function setConsigne(?Consigne $consigne): static
    {
        $this->consigne = $consigne;

        return $this;
    }

    public function getDeliveryLocation(): ?DeliveryLocation
    {
        return $this->deliveryLocation;
    }

    public function setDeliveryLocation(?DeliveryLocation $deliveryLocation): static
    {
        $this->deliveryLocation = $deliveryLocation;

        return $this;
    }

    public function getLoadingLocation(): ?LoadingLocations
    {
        return $this->loadingLocation;
    }

    public function setLoadingLocation(?LoadingLocations $loadingLocation): static
    {
        $this->loadingLocation = $loadingLocation;

        return $this;
    }

    public function getSealNumber(): ?int
    {
        return $this->sealNumber;
    }

    public function setSealNumber(int $sealNumber): static
    {
        $this->sealNumber = $sealNumber;

        return $this;
    }

    public function getQuantity(): ?int
    {
        return $this->quantity;
    }

    public function setQuantity(int $quantity): static
    {
        $this->quantity = $quantity;

        return $this;
    }

    public function getTourNumber(): ?string
    {
        return $this->tourNumber;
    }

    public function setTourNumber(string $tourNumber): static
    {
        $this->tourNumber = $tourNumber;

        return $this;
    }

    public function getArrivalTime(): ?\DateTimeImmutable
    {
        return $this->arrivalTime;
    }

    public function setArrivalTime(\DateTimeImmutable $arrivalTime): static
    {
        $this->arrivalTime = $arrivalTime;

        return $this;
    }

    public function getDepartureTime(): ?\DateTimeImmutable
    {
        return $this->departureTime;
    }

    public function setDepartureTime(\DateTimeImmutable $departureTime): static
    {
        $this->departureTime = $departureTime;

        return $this;
    }

    public function getTrailerPlate(): ?string
    {
        return $this->trailerPlate;
    }

    public function setTrailerPlate(string $trailerPlate): static
    {
        $this->trailerPlate = $trailerPlate;

        return $this;
    }

    public function getTractorPlate(): ?string
    {
        return $this->tractorPlate;
    }

    public function setTractorPlate(string $tractorPlate): static
    {
        $this->tractorPlate = $tractorPlate;

        return $this;
    }

    public function getTransporteur(): ?Transporteur
    {
        return $this->transporteur;
    }

    public function setTransporteur(?Transporteur $transporteur): static
    {
        $this->transporteur = $transporteur;

        return $this;
    }

    public function getTypeLoading(): ?TypeLoading
    {
        return $this->typeLoading;
    }

    public function setTypeLoading(?TypeLoading $typeLoading): static
    {
        $this->typeLoading = $typeLoading;

        return $this;
    }

    public function getNumberReference(): ?int
    {
        return $this->numberReference;
    }

    public function setNumberReference(int $numberReference): static
    {
        $this->numberReference = $numberReference;

        return $this;
    }

    public function getNombrePalette(): ?int
    {
        return $this->nombrePalette;
    }

    public function setNombrePalette(int $nombrePalette): static
    {
        $this->nombrePalette = $nombrePalette;

        return $this;
    }
}
