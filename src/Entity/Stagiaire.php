<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\StagiaireRepository;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass=StagiaireRepository::class)
 * @ORM\Table(name="stagiaires")
 * @UniqueEntity(fields={"sociale"}, message="Ce Stagiaire a déjà une formation")
 * @ORM\HasLifecycleCallbacks
 */
class Stagiaire
{
    const SALUTATION = ['M.' =>'M.','Mlle.' =>'Mlle.','Mme.' =>'Mme.','Dr.' =>'Dr.'];
    const DIPLOME = [
        'Diplôme national du Brevet ou Sans diplôme' => 
        'Diplôme national du Brevet ou Sans diplôme',
        'CAP ou BEP, ou Diplôme ou titre à finalité professionnelle de niveau équivalent' =>
        'CAP ou BEP, ou Diplôme ou titre à finalité professionnelle de niveau équivalent',
        'Baccalauréat (général, technologique ou professionnel), ou Diplôme ou titre à finalité professionnelle de niveau équivalent' =>
        'Baccalauréat (général, technologique ou professionnel), ou Diplôme ou titre à finalité professionnelle de niveau équivalent',
        'Diplôme ou titre à finalité professionnelle de niveau Bac+2 (DUT, BTS, DEUG)' =>
        'Diplôme ou titre à finalité professionnelle de niveau Bac+2 (DUT, BTS, DEUG)',
        'Diplôme ou titre à finalité professionnelle de niveau Bac+3 (Licence) ou Bac+4 (Maîtrise, Master 1)' =>
        'Diplôme ou titre à finalité professionnelle de niveau Bac+3 (Licence) ou Bac+4 (Maîtrise, Master 1)',
        'Diplôme ou titre à finalité professionnelle de niveau Bac+5  (Master, DEA, DESS, diplôme d\'ingénieur)' =>
        'Diplôme ou titre à finalité professionnelle de niveau Bac+5  (Master, DEA, DESS, diplôme d\'ingénieur)',
        'Diplôme ou titre à finalité professionnelle de niveau Bac+8 (Doctorat)' =>
        'Diplôme ou titre à finalité professionnelle de niveau Bac+8 (Doctorat)',
    ];
    const TEMPSLIBRE = [
        '08h-10h' => '08h-10h',
        '10h-12h' => '10h-12h',
        '12h-14h' => '12h-14h',
        '14h-16h' => '14h-16h',
        '16h-18h' => '16h-18h',
        '18h-20h' => '18h-20h',
    ];
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="cette valeur ne doit pas être vide.")
     */
    private $situation;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="cette valeur ne doit pas être vide.")
     */
    private $nomFamille;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="cette valeur ne doit pas être vide.")
     */
    private $nomNaissance;
    
    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="cette valeur ne doit pas être vide.")
     */
    private $prenom;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="cette valeur ne doit pas être vide.")
     * @Assert\Email(
     *     message = " l'email '{{ value }}' n'est pas valide."
     * )
     */
    private $email;

    /**
     * @ORM\Column(type="integer")
     * @Assert\NotBlank(message="cette valeur ne doit pas être vide.")
     * @Assert\Range(
     *      min = 100000000,
     *      max = 999999999,
     *      notInRangeMessage = "Numéro invalide, le N° doit contenir 9 chiffres",
     * )
     */
    private $mobile;

    /**
     * @ORM\Column(type="integer")
     * @Assert\NotBlank(message="cette valeur ne doit pas être vide.")
     * @Assert\Range(
     *      min = 100000000,
     *      max = 999999999,
     *      notInRangeMessage = "Numéro invalide, le N° doit contenir 9 chiffres",
     * )
     */
    private $fixe;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="cette valeur ne doit pas être vide.")
     */
    private $adresse;

    /**
     * @ORM\Column(type="date")
     * @Assert\NotBlank(message="cette valeur ne doit pas être vide.")
     * @Assert\Type("\DateTimeInterface")
     */
    private $birthday;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="cette valeur ne doit pas être vide.")
     */
    private $sociale;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="cette valeur ne doit pas être vide.")
     */
    private $diplome;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="cette valeur ne doit pas être vide.")
     */
    private $emploi;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="cette valeur ne doit pas être vide.")
     */
    private $nDossier;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="cette valeur ne doit pas être vide.")
     */
    private $formation;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="cette valeur ne doit pas être vide.")
     */
    private $tempsLibre;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * @ORM\Column(type="datetime")
     */
    private $updatedAt;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $comment;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="stagiaires")
     */
    private $user;

    /**
     * @ORM\Column(type="datetime")
     * @Assert\NotBlank(message="cette valeur ne doit pas être vide.")
     */
    private $rdvFormateur;

    /**
     * @ORM\Column(type="float")
     * @Assert\NotBlank(message="cette valeur ne doit pas être vide.")
     */
    private $fondDisponible;

    /**
     * @ORM\Column(type="float")
     * @Assert\NotBlank(message="cette valeur ne doit pas être vide.")
     */
    private $prixFormation;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSituation(): ?string
    {
        return $this->situation;
    }

    public function setSituation(?string $situation): self
    {
        $this->situation = $situation;

        return $this;
    }

    public function getNomFamille(): ?string
    {
        return $this->nomFamille;
    }

    public function setNomFamille(?string $nomFamille): self
    {
        $this->nomFamille = $nomFamille;

        return $this;
    }

    public function getNomNaissance(): ?string
    {
        return $this->nomNaissance;
    }

    public function setNomNaissance(?string $nomNaissance): self
    {
        $this->nomNaissance = $nomNaissance;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(?string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(?string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getMobile(): ?int
    {
        return $this->mobile;
    }

    public function setMobile(int $mobile): self
    {
        $this->mobile = $mobile;

        return $this;
    }

    public function getFixe(): ?int
    {
        return $this->fixe;
    }

    public function setFixe(int $fixe): self
    {
        $this->fixe = $fixe;

        return $this;
    }

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(?string $adresse): self
    {
        $this->adresse = $adresse;

        return $this;
    }

    public function getBirthday(): ?\DateTimeInterface
    {
        return $this->birthday;
    }

    public function setBirthday(?\DateTimeInterface $birthday): self
    {
        $this->birthday = $birthday;

        return $this;
    }

    public function getSociale(): ?string
    {
        return $this->sociale;
    }

    public function setSociale(string $sociale): self
    {
        $this->sociale = $sociale;

        return $this;
    }

    public function getDiplome(): ?string
    {
        return $this->diplome;
    }

    public function setDiplome(?string $diplome): self
    {
        $this->diplome = $diplome;

        return $this;
    }

    public function getEmploi(): ?string
    {
        return $this->emploi;
    }

    public function setEmploi(?string $emploi): self
    {
        $this->emploi = $emploi;

        return $this;
    }

    public function getNDossier(): ?string
    {
        return $this->nDossier;
    }

    public function setNDossier(?string $nDossier): self
    {
        $this->nDossier = $nDossier;

        return $this;
    }

    public function getFormation(): ?string
    {
        return $this->formation;
    }

    public function setFormation(?string $formation): self
    {
        $this->formation = $formation;

        return $this;
    }

    public function getTempsLibre(): ?string
    {
        return $this->tempsLibre;
    }

    public function setTempsLibre(?string $tempsLibre): self
    {
        $this->tempsLibre = $tempsLibre;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(\DateTimeInterface $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * @ORM\PrePersist
     * @ORM\PreUpdate
     */
    public function updateTimestamps ()
    {
        if ($this->getCreatedAt() === null) {
            $this->setCreatedAt(new \DateTimeImmutable);
        }

        $this->setUpdatedAt(new \DateTimeImmutable);
    }

    public function getComment(): ?string
    {
        return $this->comment;
    }

    public function setComment(?string $comment): self
    {
        $this->comment = $comment;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getRdvFormateur(): ?\DateTimeInterface
    {
        return $this->rdvFormateur;
    }

    public function setRdvFormateur(?\DateTimeInterface $rdvFormateur): self
    {
        $this->rdvFormateur = $rdvFormateur;

        return $this;
    }

    public function getFondDisponible(): ?float
    {
        return $this->fondDisponible;
    }

    public function setFondDisponible(?float $fondDisponible): self
    {
        $this->fondDisponible = $fondDisponible;

        return $this;
    }

    public function getPrixFormation(): ?float
    {
        return $this->prixFormation;
    }

    public function setPrixFormation(?float $prixFormation): self
    {
        $this->prixFormation = $prixFormation;

        return $this;
    }
}
