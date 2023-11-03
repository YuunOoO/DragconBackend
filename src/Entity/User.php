<?php
// api/src/Entity/User.php
namespace App\Entity;

use ApiPlatform\Metadata\ApiProperty;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Metadata\ApiResource;
use Symfony\Component\Routing\RouterInterface;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\Post;
use ApiPlatform\Metadata\Patch;
use ApiPlatform\Metadata\Delete;
use App\Controller\UserController;

#[ORM\Entity]
#[ApiResource(operations: [
    new GetCollection(
        name: 'users_by_ekipa',
        routeName: "team_users",
        uriTemplate: '/users-by-ekipa/{ekipa_id}',
        controller: UserController::class,
    ),
    new Get(controller: null),
    new Post(),
    new Patch(),
    new Delete()
])]
class User
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[ApiProperty(identifier: true)]
    private ?int $key_id = null;

    #[ORM\Column(length: 255)]
    private ?string $id = null;

    #[ORM\Column(length: 255)]
    private ?string $password = null;

    #[ORM\Column]
    private ?int $admin = null;

    #[ORM\Column(length: 255)]
    private ?string $email = null;

    #[ORM\ManyToOne(targetEntity: "Team")]
    #[ORM\JoinColumn(name: "ekipa_id", referencedColumnName: "ekipa_id")]
    #[ApiProperty(example:"/api/teams/{ekipa_id}")]
    private $team;

    public function getKeyId(): ?int
    {
        return $this->key_id;
    }

    public function getId(): ?string
    {
        return $this->id;
    }

    public function setId(?string $id): self
    {
        $this->id = $id;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(?string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function getAdmin(): ?int
    {
        return $this->admin;
    }

    public function setAdmin(?int $admin): self
    {
        $this->admin = $admin;

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


    public function getTeam(): ?Team
    {
        return $this->team;
    }

    public function setTeam(?Team $team): self
    {
        $this->team = $team;
        return $this;
    }


    public function getTeamUrl(RouterInterface $router): string
    {
        return $this->team->getTeamUrl($router);
    }


    public function getEkipaId(): ?int
    {
        if ($this->team) {
            return $this->team->getEkipaId();
        }

        return null;
    }
}
