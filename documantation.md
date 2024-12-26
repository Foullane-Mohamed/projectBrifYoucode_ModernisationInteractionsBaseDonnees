# Guide Complet de la Programmation Orientée Objet en PHP

## Table des matières

1. [Introduction à la POO en PHP](#introduction)
2. [Encapsulation et Modificateurs d'Accès](#encapsulation)
3. [Héritage et Polymorphisme](#heritage)
4. [Interfaces et Traits](#interfaces)
5. [Namespaces et Autoloading](#namespaces)
6. [Méthodes Magiques](#methodes-magiques)
7. [Gestion des Erreurs et Exceptions](#erreurs)
8. [Principes SOLID](#solid)

## Introduction à la POO en PHP {#introduction}

La Programmation Orientée Objet (POO) est un paradigme de programmation qui organise le code en objets, qui sont des instances de classes. En PHP, la POO permet de créer un code plus modulaire, réutilisable et maintenable.

### Création d'une classe de base

```php
class Utilisateur {
    // Propriétés
    private $nom;
    private $email;

    // Constructeur
    public function __construct(string $nom, string $email) {
        $this->nom = $nom;
        $this->email = $email;
    }

    // Méthodes
    public function getNom(): string {
        return $this->nom;
    }

    public function getEmail(): string {
        return $this->email;
    }
}

// Création d'une instance
$utilisateur = new Utilisateur("Jean Dupont", "jean@example.com");
```

## Encapsulation et Modificateurs d'Accès {#encapsulation}

L'encapsulation est un concept fondamental qui consiste à regrouper les données et les méthodes qui les manipulent au sein d'une même unité ou objet.

### Modificateurs d'accès

- `public`: Accessible de partout
- `private`: Accessible uniquement dans la classe
- `protected`: Accessible dans la classe et ses classes enfants

```php
class Compte {
    private $solde;        // Accessible uniquement dans cette classe
    protected $type;       // Accessible dans cette classe et ses enfants
    public $proprietaire;  // Accessible de partout

    public function deposer(float $montant): void {
        if ($montant > 0) {
            $this->solde += $montant;
        }
    }
}
```

## Héritage et Polymorphisme {#heritage}

L'héritage permet à une classe d'hériter des propriétés et méthodes d'une autre classe.

```php
class CompteCourant extends Compte {
    private $decouvertAutorise;

    public function __construct(float $soldeInitial, float $decouvert) {
        parent::__construct($soldeInitial);
        $this->decouvertAutorise = $decouvert;
    }

    public function retirer(float $montant): bool {
        if ($this->solde - $montant >= -$this->decouvertAutorise) {
            $this->solde -= $montant;
            return true;
        }
        return false;
    }
}
```

### Polymorphisme

Le polymorphisme permet aux classes enfants de redéfinir des méthodes de la classe parente.

```php
abstract class Animal {
    abstract public function faireBruit(): string;
}

class Chat extends Animal {
    public function faireBruit(): string {
        return "Miaou!";
    }
}

class Chien extends Animal {
    public function faireBruit(): string {
        return "Wouf!";
    }
}
```

## Interfaces et Traits {#interfaces}

### Interfaces

Les interfaces définissent un contrat que les classes doivent respecter.

```php
interface Payable {
    public function calculerPrix(): float;
    public function appliquerTaxe(float $taux): float;
}

class Produit implements Payable {
    private $prix;

    public function calculerPrix(): float {
        return $this->prix;
    }

    public function appliquerTaxe(float $taux): float {
        return $this->prix * (1 + $taux);
    }
}
```

### Traits

Les traits permettent de réutiliser du code dans plusieurs classes.

```php
trait Logger {
    private $logs = [];

    public function log(string $message): void {
        $this->logs[] = date('Y-m-d H:i:s') . ': ' . $message;
    }

    public function getLogs(): array {
        return $this->logs;
    }
}

class Service {
    use Logger;

    public function effectuerOperation(): void {
        $this->log("Opération effectuée");
    }
}
```

## Namespaces et Autoloading {#namespaces}

Les namespaces permettent d'organiser le code et d'éviter les conflits de noms.

```php
namespace App\Services;

use App\Models\Utilisateur;
use App\Interfaces\ServiceInterface;

class UtilisateurService implements ServiceInterface {
    public function creerUtilisateur(array $donnees): Utilisateur {
        // Implémentation
    }
}
```

### Autoloading avec Composer

```php
// composer.json
{
    "autoload": {
        "psr-4": {
            "App\\": "src/"
        }
    }
}
```

## Méthodes Magiques {#methodes-magiques}

PHP propose plusieurs méthodes magiques pour personnaliser le comportement des objets.

```php
class Exemple {
    private $donnees = [];

    // Constructeur
    public function __construct() {
        // Initialisation
    }

    // Getter magique
    public function __get($nom) {
        return $this->donnees[$nom] ?? null;
    }

    // Setter magique
    public function __set($nom, $valeur) {
        $this->donnees[$nom] = $valeur;
    }

    // Appelé lors de la destruction de l'objet
    public function __destruct() {
        // Nettoyage
    }

    // Appelé lors de la sérialisation
    public function __sleep() {
        return ['donnees'];
    }
}
```

## Gestion des Erreurs et Exceptions {#erreurs}

La gestion des erreurs en POO se fait principalement via les exceptions.

```php
class ValidationException extends Exception {}

class Formulaire {
    public function valider(array $donnees): void {
        try {
            if (empty($donnees['email'])) {
                throw new ValidationException("L'email est requis");
            }

            if (!filter_var($donnees['email'], FILTER_VALIDATE_EMAIL)) {
                throw new ValidationException("L'email n'est pas valide");
            }
        } catch (ValidationException $e) {
            // Gestion de l'erreur
            $this->logErreur($e->getMessage());
            throw $e;
        } finally {
            // Code exécuté dans tous les cas
        }
    }
}
```

## Principes SOLID {#solid}

Les principes SOLID sont des lignes directrices pour créer des architectures logicielles maintenables.

### Single Responsibility Principle (SRP)

Une classe ne devrait avoir qu'une seule raison de changer.

```php
// Mauvais exemple
class Utilisateur {
    public function sauvegarder() { /* ... */ }
    public function envoyerEmail() { /* ... */ }
    public function genererFacture() { /* ... */ }
}

// Bon exemple
class Utilisateur {
    private $email;
    private $nom;
}

class UtilisateurRepository {
    public function sauvegarder(Utilisateur $utilisateur) { /* ... */ }
}

class EmailService {
    public function envoyerEmail(string $to, string $contenu) { /* ... */ }
}
```

### Open/Closed Principle (OCP)

Les entités doivent être ouvertes à l'extension mais fermées à la modification.

```php
interface CalculateurPrix {
    public function calculer(Commande $commande): float;
}

class CalculateurPrixNormal implements CalculateurPrix {
    public function calculer(Commande $commande): float {
        return $commande->getMontantTotal();
    }
}

class CalculateurPrixSoldes implements CalculateurPrix {
    public function calculer(Commande $commande): float {
        return $commande->getMontantTotal() * 0.8; // 20% de réduction
    }
}
```

### Liskov Substitution Principle (LSP)

Les objets d'une classe dérivée doivent pouvoir remplacer les objets de la classe de base sans altérer la cohérence du programme.

```php
class Rectangle {
    protected $largeur;
    protected $hauteur;

    public function setLargeur(float $largeur): void {
        $this->largeur = $largeur;
    }

    public function setHauteur(float $hauteur): void {
        $this->hauteur = $hauteur;
    }

    public function calculerAire(): float {
        return $this->largeur * $this->hauteur;
    }
}

class Carre extends Rectangle {
    public function setLargeur(float $cote): void {
        $this->largeur = $cote;
        $this->hauteur = $cote;
    }

    public function setHauteur(float $cote): void {
        $this->largeur = $cote;
        $this->hauteur = $cote;
    }
}
```

### Interface Segregation Principle (ISP)

Les clients ne devraient pas être forcés de dépendre d'interfaces qu'ils n'utilisent pas.

```php
// Mauvais exemple
interface Travailleur {
    public function travailler(): void;
    public function manger(): void;
    public function dormir(): void;
}

// Bon exemple
interface Travaillable {
    public function travailler(): void;
}

interface Reposable {
    public function dormir(): void;
}

interface Mangeable {
    public function manger(): void;
}

class Employe implements Travaillable, Reposable, Mangeable {
    public function travailler(): void { /* ... */ }
    public function dormir(): void { /* ... */ }
    public function manger(): void { /* ... */ }
}
```

### Dependency Inversion Principle (DIP)

Les modules de haut niveau ne devraient pas dépendre des modules de bas niveau. Les deux devraient dépendre d'abstractions.

```php
interface StorageInterface {
    public function sauvegarder(string $donnees): void;
}

class StorageFichier implements StorageInterface {
    public function sauvegarder(string $donnees): void {
        file_put_contents('donnees.txt', $donnees);
    }
}

class StorageDatabase implements StorageInterface {
    public function sauvegarder(string $donnees): void {
        // Sauvegarde en base de données
    }
}

class Service {
    private $storage;

    public function __construct(StorageInterface $storage) {
        $this->storage = $storage;
    }

    public function effectuerOperation(): void {
        // Utilisation du storage via l'interface
        $this->storage->sauvegarder('données');
    }
}
```

## Conclusion

La programmation orientée objet en PHP offre un cadre puissant pour développer des applications robustes et maintenables. En suivant les principes SOLID et en utilisant les fonctionnalités avancées de PHP, vous pouvez créer des architectures logicielles flexibles et évolutives.

Les concepts présentés dans ce document constituent une base solide pour développer des applications PHP professionnelles. La pratique et l'expérience vous permettront d'approfondir ces concepts et de les appliquer efficacement dans vos projets.
