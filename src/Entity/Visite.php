<?php

namespace App\Entity;

use App\Repository\VisiteRepository;
use DateTime;
use DateTimeInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Context\ExecutionContextInterface;
use Vich\UploaderBundle\Mapping\Annotation as Vich;


  
#[ORM\Entity(repositoryClass: VisiteRepository::class)]
  
 
/**
 * @ORM\Entity(repositoryClass="VisiteRepository")
 * @Vich\Uploadable
 */
class Visite
{
     /**
     * NOTE:This is not a mapped field of entity metadata;just a simple property.
     * @Vich\UploadableField(mapping="visites", fileNameProperty="imageName")
      * @Assert\Image(mimeTypes="image/jpeg")
     * @var File|null
     */
    private $imageFile;
    /**
    * @ORM\Column(type="integer", nullable=true)
    * @Assert\Range(min = 0, max=20)
    */
    private $note;
  // /**
    // * @ORM\Column(type="date", nullable=true)
    // * @Assert\LessThanOrEqual("now")
     //*/
    //private $datecreation;


    /**
     *
     * 
     * @var string|null
     */
    #[ORM\Column( length:255, nullable:true)] 
     
    private ?string $imageName=null;
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $ville = null;

    #[ORM\Column(length: 50)]
    private ?string $pays = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?DateTimeInterface $datecreation = null;

    
    //#[ORM\Column(nullable: true)]
    //private ?int $note = null;
   

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $avis = null;

    #[ORM\Column(nullable: true)]
    private ?int $tempmin = null;

    //#[ORM\Column(nullable: true)]
    //private ?int $tempmax = null;
    /**
     * @ORM\Column(type="integer", nullable=true)
     * @Assert\GreaterThan(propertyPath="tempmin")
    */
    private $tempmax;



    #[ORM\ManyToMany(targetEntity: Environnement::class)]
    private Collection $environnements;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $updated_at = null;

    public function __construct()
    {
        $this->environnements = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getVille(): ?string
    {
        return $this->ville;
    }

    public function setVille(string $ville): self
    {
        $this->ville = $ville;

        return $this;
    }

    public function getPays(): ?string
    {
        return $this->pays;
    }

    public function setPays(string $pays): self
    {
        $this->pays = $pays;

        return $this;
    }

    public function getDatecreation(): ?DateTimeInterface
    {
        return $this->datecreation;
    }

    public function setDatecreation(?DateTimeInterface $datecreation): self
    {
        $this->datecreation = $datecreation;

        return $this;
    }

    public function getNote(): ?int
    {
        return $this->note;
    }

    public function setNote(?int $note): self
    {
        $this->note = $note;

        return $this;
    }

    public function getAvis(): ?string
    {
        return $this->avis;
    }

    public function setAvis(?string $avis): self
    {
        $this->avis = $avis;

        return $this;
    }

    public function getTempmin(): ?int
    {
        return $this->tempmin;
    }

    public function setTempmin(?int $tempmin): self
    {
        $this->tempmin = $tempmin;

        return $this;
    }

    public function getTempmax(): ?int
    {
        return $this->tempmax;
    }

    public function setTempmax(?int $tempmax): self
    {
        $this->tempmax = $tempmax;

        return $this;
    }
    public function getDatecreationString(): string {
        if($this->datecreation==null){
            return"";
        }else{
            return $this->datecreation->format('d/m/y');
        }
        
    }

    /**
     * @return Collection<int, Environnement>
     */
    public function getEnvironnements(): Collection
    {
        return $this->environnements;
    }

    public function addEnvironnement(Environnement $environnement): self
    {
        if (!$this->environnements->contains($environnement)) {
            $this->environnements->add($environnement);
        }

        return $this;
    }

    public function removeEnvironnement(Environnement $environnement): self
    {
        $this->environnements->removeElement($environnement);

        return $this;
    }
   
    function getImageFile(): ?File{
       
           return $this->imageFile;
    }
    function getImageName(): ?string{
        return $this->imageName;
    }
    function setImageFile(File $imageFile): self{
        $this->imageFile= $imageFile;
        if($this->imageFile instanceof UploadeFile){
            $this->updated_at=new DateTime('now');
        }
        return $this;
    }
    function setImageName($imageName): self {
        $this->imageName= $imageName;
        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updated_at;
    }

    public function setUpdatedAt(?\DateTimeInterface $updated_at): self
    {
        $this->updated_at = $updated_at;

        return $this;
    }
     
   
   
  


    /**
     * @Assert\Callback
     * @param ExecutionContextInterface $context
     */
    public function validate(ExecutionContextInterface $context) {
        
        $image= $this->getImageFile();
        if($image != null && $image !=""){
            $tailleImage=@getimagesize($image);
            if(!($tailleImage==false)){
                if($tailleImage[0]>1300 || $tailleImage[1]>1300){
                    $context->buildViolation("Cette image est trop grande (1300x1300 max)")
                            ->atPath('imageFile')
                            ->addViolation();
                }
                else{
                    $context->buildViolation("Ce n'est pas une image")
                            ->atPath('imageFile')
                            ->addViolation();
                                   
                }
            }
        }
        
   
    }
     ///**
     //* @ORM\Column(type="integer", nullable=true)
     //* @Assert\Range(min = 0, max=20)
     //*/
   // private $note;
    
}
