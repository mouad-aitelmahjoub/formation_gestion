<?php

namespace App\Entity;

use App\Repository\StagiaireRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=StagiaireRepository::class)
 * @ORM\Table(name="stagiaires")
 * @ORM\HasLifecycleCallbacks
 */
class Stagiaire
{
    const SALUTATION = [' ' => NULL,'M.' =>'M.','Mlle.' =>'Mlle.','Mme.' =>'Mme.','Dr.' =>'Dr.'];
    const DIPLOME = [
        ' ' => NULL,
        'Niveau 1 (Diplôme de niveau égal et supérieur à bac+4 ou 5 : master, doctorat...)' => 'Niveau 1 (Diplôme de niveau égal et supérieur à bac+4 ou 5 : master, doctorat...)',
        'Niveau 2 (Diplôme de niveau bac+3 ou 4 : licence, maîtrise ou équivalent)' =>
        'Niveau 2 (Diplôme de niveau bac+3 ou 4 : licence, maîtrise ou équivalent)',
        'Niveau 3 (Diplôme de niveau bac+2 : DUT, BTS, écoles des formations sanitaires ou sociales…)' =>
        'Niveau 3 (Diplôme de niveau bac+2 : DUT, BTS, écoles des formations sanitaires ou sociales…)',
        'Niveau 4 (Bac général, technologique ou professionnel, BP, BT ou équivalent, abandon des études)' =>
        'Niveau 4 (Bac général, technologique ou professionnel, BP, BT ou équivalent, abandon des études)',
        'Niveau 5 (CAP ou BEP, sortie de 2nd cycle général et technologique avant l’année terminale)' =>
        'Niveau 5 (CAP ou BEP, sortie de 2nd cycle général et technologique avant l’année terminale)',
        'Niveau 6 (Sortie en cours de 1er cycle (de la 6e  à la 3e ), abandon CAP, BEP) ' =>
        'Niveau 6 (Sortie en cours de 1er cycle (de la 6e  à la 3e ), abandon CAP, BEP) ',
    ];
    const TEMPSLIBRE = [
        ' ' => NULL,
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

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSituation(): ?string
    {
        return $this->situation;
    }

    public function setSituation(string $situation): self
    {
        $this->situation = $situation;

        return $this;
    }

    public function getNomFamille(): ?string
    {
        return $this->nomFamille;
    }

    public function setNomFamille(string $nomFamille): self
    {
        $this->nomFamille = $nomFamille;

        return $this;
    }

    public function getNomNaissance(): ?string
    {
        return $this->nomNaissance;
    }

    public function setNomNaissance(string $nomNaissance): self
    {
        $this->nomNaissance = $nomNaissance;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
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

    public function setAdresse(string $adresse): self
    {
        $this->adresse = $adresse;

        return $this;
    }

    public function getBirthday(): ?\DateTimeInterface
    {
        return $this->birthday;
    }

    public function setBirthday(\DateTimeInterface $birthday): self
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

    public function setDiplome(string $diplome): self
    {
        $this->diplome = $diplome;

        return $this;
    }

    public function getEmploi(): ?string
    {
        return $this->emploi;
    }

    public function setEmploi(string $emploi): self
    {
        $this->emploi = $emploi;

        return $this;
    }

    public function getNDossier(): ?string
    {
        return $this->nDossier;
    }

    public function setNDossier(string $nDossier): self
    {
        $this->nDossier = $nDossier;

        return $this;
    }

    public function getFormation(): ?string
    {
        return $this->formation;
    }

    public function setFormation(string $formation): self
    {
        $this->formation = $formation;

        return $this;
    }

    public function getTempsLibre(): ?string
    {
        return $this->tempsLibre;
    }

    public function setTempsLibre(string $tempsLibre): self
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
}
