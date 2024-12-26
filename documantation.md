# Documentation

## 1. La Programmation Orientée Objet (POO)

**Définition**: Paradigme de programmation qui organise le code en objets contenant des données et du code.
 Ces objets sont des instances de classes qui servent de modèles.

```php
class Voiture {
    private $marque;
    private $modele;

    public function __construct($marque, $modele) {
        $this->marque = $marque;
        $this->modele = $modele;
    }
}
```

## 2. Encapsulation

**Définition**: Principe qui consiste à regrouper les données et les méthodes 
qui les manipulent au sein d'une même unité (la classe) et à restreindre l'accès à certains composants.

```php
class CompteBancaire {
    private $solde;  // Données encapsulées

    public function deposer($montant) {
        if ($montant > 0) {
            $this->solde += $montant;
        }
    }
}
```

## 3. Abstraction

**Définition**: Principe permettant de masquer la complexité en exposant uniquement les fonctionnalités nécessaires à l'utilisation de l'objet.

```php
abstract class FormeGeometrique {
    abstract public function calculerAire();
    abstract public function calculerPerimetre();
}
```

## 4. Héritage

**Définition**: Mécanisme permettant à une classe (classe fille) d'hériter des propriétés et méthodes d'une autre classe (classe mère).

```php
class Vehicule {
    protected $marque;

    public function demarrer() {
        return "Véhicule démarré";
    }
}

class Voiture extends Vehicule {
    public function klaxonner() {
        return "Beep beep!";
    }
}
```

## 5. Polymorphisme

**Définition**: Capacité d'objets de différentes classes à répondre à la même interface de manière différente.

```php
interface Animal {
    public function faireBruit();
}

class Chat implements Animal {
    public function faireBruit() {
        return "Miaou!";
    }
}

class Chien implements Animal {
    public function faireBruit() {
        return "Wouaf!";
    }
}
```

## 6. Classes Abstraites

**Définition**: Classes qui ne peuvent pas être instanciées directement et qui servent de modèle pour d'autres classes.

```php
abstract class Database {
    abstract public function connect();
    abstract public function query($sql);

    public function executeQuery($sql) {
        $this->connect();
        return $this->query($sql);
    }
}
```

## 7. Interfaces

**Définition**: Contrats définissant un ensemble de méthodes que les classes qui les implémentent doivent obligatoirement définir.

```php
interface Payable {
    public function calculerPrix();
    public function effectuerPaiement();
}

class Commande implements Payable {
    public function calculerPrix() {
        // Implémentation
    }

    public function effectuerPaiement() {
        // Implémentation
    }
}
```

## 8. Constructeurs et Destructeurs

**Définition**: Méthodes spéciales appelées automatiquement lors de la création (constructeur) ou de la destruction (destructeur) d'un objet.

```php
class Fichier {
    private $handle;

    public function __construct($filename) {
        $this->handle = fopen($filename, 'r');
    }

    public function __destruct() {
        fclose($this->handle);
    }
}
```

## 9. Modificateurs d'Accès

**Définition**: Mots-clés définissant la visibilité des propriétés et méthodes d'une classe.

```php
class Produit {
    private $prix;      // Accessible uniquement dans la classe
    protected $nom;     // Accessible dans la classe et les classes filles
    public $reference;  // Accessible partout
}
```

## 10. Méthodes et Propriétés Statiques

**Définition**: Éléments appartenant à la classe elle-même plutôt qu'à une instance spécifique.

```php
class Math {
    public static $pi = 3.14159;

    public static function calculerCirconference($rayon) {
        return 2 * self::$pi * $rayon;
    }
}
```

## 11. Espaces de Noms (Namespaces)

**Définition**: Mécanisme permettant d'organiser les classes en groupes logiques et d'éviter les conflits de noms.

```php
namespace App\Finance;

class Transaction {
    private $montant;

    public function __construct($montant) {
        $this->montant = $montant;
    }
}

// Utilisation
use App\Finance\Transaction;
$transaction = new Transaction(100);
```

## 12. Autoloading

**Définition**: Mécanisme permettant de charger automatiquement les classes PHP lorsqu'elles sont utilisées.

```php
// composer.json
{
    "autoload": {
        "psr-4": {
            "App\\": "src/"
        }
    }
}

// Utilisation de l'autoloader
require_once 'vendor/autoload.php';
```

## Exemple Complet d'Utilisation

```php
// Création d'objets
$compte = new CompteBancaire();
$compte->deposer(1000);

// Utilisation du polymorphisme
$animaux = [new Chat(), new Chien()];
foreach ($animaux as $animal) {
    echo $animal->faireBruit();
}

// Utilisation de méthodes statiques
echo Math::calculerCirconference(5);
```
