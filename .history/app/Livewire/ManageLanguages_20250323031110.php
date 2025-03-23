<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Arr;

class ManageLanguages extends Component
{
    public $languages = [];
    public $newLanguage = '';
    public $translations = [];
    public $selectedLanguage = 'fr';
    public $searchFilter = '';
    public $originalTranslations = [];
    public $frenchTranslations = []; // Pour stocker les traductions en français
    public $currentTranslations = []; // Pour stocker les traductions actuelles
    public $isSaving = false; // Pour désactiver le bouton pendant la sauvegarde
    public $filteredTranslations = [];

    public function mount()
    {
        $this->languages = $this->getAvailableLanguages();
        $this->loadTranslations($this->selectedLanguage);
        // Charger les traductions françaises au démarrage
        if ($this->selectedLanguage !== 'fr') {
            $this->loadFrenchTranslations();
        }
    }

    // Ajoutez cette méthode ou modifiez-la si elle existe déjà
    public function updatedSearchFilter()
    {
        // Cette méthode sera appelée automatiquement quand searchFilter change
        $this->filterTranslations();
    }

    // Modifiez la méthode filterTranslations pour filtrer sur les clés ET les valeurs
    protected function filterTranslations()
    {
        if (empty($this->searchFilter)) {
            $this->filteredTranslations = $this->translations;
            return;
        }

        $searchTerm = strtolower($this->searchFilter);
        $this->filteredTranslations = array_filter($this->translations, function ($value, $key) use ($searchTerm) {
            // Recherche dans la clé
            if (str_contains(strtolower($key), $searchTerm)) {
                return true;
            }

            // Recherche dans la valeur
            if (is_string($value) && str_contains(strtolower($value), $searchTerm)) {
                return true;
            }

            return false;
        }, ARRAY_FILTER_USE_BOTH);
    }

    // Assurez-vous que la méthode resetFilter existe
    public function resetFilter()
    {
        $this->searchFilter = '';
        $this->filterTranslations();
    }

    public function updateFilteredTranslations()
    {
        if (!is_array($this->translations)) {
            $this->filteredTranslations = [];
            return;
        }

        if (empty($this->searchFilter)) {
            $this->filteredTranslations = $this->translations;
        } else {
            // Modification pour rechercher à la fois dans les clés et les valeurs
            $this->filteredTranslations = array_filter($this->translations, function ($value, $key) {
                $searchLower = strtolower($this->searchFilter);
                $keyHasMatch = stripos($key, $this->searchFilter) !== false;
                $valueHasMatch = is_string($value) && stripos(strtolower($value), $searchLower) !== false;
                return $keyHasMatch || $valueHasMatch;
            }, ARRAY_FILTER_USE_BOTH);
        }
    }

    // Mettre à jour pour réagir immédiatement aux changements
    public function updatedSearchFilter()
    {
        $this->updateFilteredTranslations();
    }

    public function getAvailableLanguages()
    {
        // Chemin vers le dossier des langues (ajusté pour être plus flexible)
        $langPath = base_path('lang');

        // Si le dossier n'existe pas dans le chemin de base, essayer le chemin des ressources
        if (!File::exists($langPath)) {
            $langPath = resource_path('lang');
        }

        $directories = File::directories($langPath);
        $languages = [];

        foreach ($directories as $directory) {
            $languages[] = basename($directory);
        }

        // Trier les langues par ordre alphabétique
        sort($languages);

        return $languages;
    }

    // Méthode pour charger les traductions françaises
    private function loadFrenchTranslations()
    {
        // Chercher les traductions françaises
        $langPath = base_path('lang/fr');
        if (!File::exists($langPath)) {
            $langPath = resource_path('lang/fr');
        }

        $filePath = "$langPath/messages.php";

        if (File::exists($filePath)) {
            // Charger les traductions depuis le fichier
            $translations = include $filePath;

            // Aplatir le tableau multidimensionnel des traductions
            $flattenedTranslations = [];
            $this->flattenArray($translations, $flattenedTranslations);
            $this->frenchTranslations = $flattenedTranslations;
        } else {
            $this->frenchTranslations = [];
        }
    }

    public function loadTranslations($language)
    {
        $this->selectedLanguage = $language;

        // Chercher les traductions aux emplacements possibles
        $langPath = base_path("lang/$language");
        if (!File::exists($langPath)) {
            $langPath = resource_path("lang/$language");
        }

        $filePath = "$langPath/messages.php";

        if (File::exists($filePath)) {
            // Charger les traductions depuis le fichier
            $translations = include $filePath;
            $this->originalTranslations = $translations;

            // Aplatir le tableau multidimensionnel des traductions
            $flattenedTranslations = [];
            $this->flattenArray($translations, $flattenedTranslations);
            $this->translations = $flattenedTranslations;
            $this->currentTranslations = $flattenedTranslations; // Stocker les traductions actuelles
        } else {
            $this->translations = [];
            $this->originalTranslations = [];
            $this->currentTranslations = []; // Réinitialiser les traductions actuelles
            $this->dispatch('config-updated', [
                'message' => "Fichier de traduction introuvable pour la langue '$language'.",
                'type' => 'error'
            ]);
        }

        // Si la langue sélectionnée n'est pas le français, charger les traductions françaises
        if ($language !== 'fr') {
            $this->loadFrenchTranslations();
        } else {
            // Si c'est le français, on utilise les mêmes traductions
            $this->frenchTranslations = $this->translations;
        }

        // Mettre à jour les traductions filtrées avec le filtre actuel
        $this->updateFilteredTranslations();
    }

    private function flattenArray(array $array, array &$result, string $prefix = '')
    {
        foreach ($array as $key => $value) {
            $newKey = $prefix ? $prefix . '.' . $key : $key;

            if (is_array($value)) {
                $this->flattenArray($value, $result, $newKey);
            } else {
                $result[$newKey] = $value;
            }
        }
    }

    private function unflattenArray(array $flattenedArray)
    {
        $result = [];

        foreach ($flattenedArray as $key => $value) {
            Arr::set($result, $key, $value);
        }

        return $result;
    }

    // Dans la classe ManageLanguages, ajoutons une propriété pour suivre l'état d'ajout
    public $isAddingLanguage = false;

    // Modifions la méthode addLanguage
    // Dans la classe ManageLanguages, modifiez la méthode addLanguage
    public function addLanguage()
    {
        // Validation du code de langue
        if (empty($this->newLanguage)) {
            $this->dispatch('language-update-failed', [
                'message' => 'Veuillez saisir un code de langue.',
                'type' => 'error'
            ]);
            return;
        }

        // Valider le format du code de langue (2-5 caractères alphabétiques)
        if (!preg_match('/^[a-z]{2,5}$/', $this->newLanguage)) {
            $this->dispatch('language-update-failed', [
                'message' => 'Le code de langue doit être composé de 2 à 5 lettres minuscules (ex: fr, en, es).',
                'type' => 'error'
            ]);
            return;
        }

        // Déterminer le chemin de langue
        $langBasePath = base_path('lang');
        if (!File::exists($langBasePath)) {
            $langBasePath = resource_path('lang');
        }

        $langPath = "$langBasePath/{$this->newLanguage}";

        if (File::exists($langPath)) {
            $this->dispatch('language-update-failed', [
                'message' => "La langue '{$this->newLanguage}' existe déjà.",
                'type' => 'error'
            ]);
            return;
        }

        try {
            // Créer le répertoire pour la nouvelle langue
            File::makeDirectory($langPath, 0755, true, true);

            // Trouver une langue source existante (préférer fr, sinon prendre la première disponible)
            $sourceLang = 'fr';
            $sourceFile = "$langBasePath/$sourceLang/messages.php";

            if (!File::exists($sourceFile)) {
                // Si le français n'existe pas, prendre la première langue disponible
                foreach ($this->languages as $lang) {
                    $potentialSource = "$langBasePath/$lang/messages.php";
                    if (File::exists($potentialSource)) {
                        $sourceFile = $potentialSource;
                        break;
                    }
                }
            }

            $destinationFile = "$langPath/messages.php";

            if (File::exists($sourceFile)) {
                File::copy($sourceFile, $destinationFile);

                // Stocker le nom de la langue ajoutée pour le message de succès
                $addedLang = $this->newLanguage;
                $this->newLanguage = '';

                // Mettre à jour la liste des langues
                $this->languages = $this->getAvailableLanguages();

                $this->dispatch('language-updated', [
                    'message' => "Langue '$addedLang' ajoutée avec succès.",
                    'type' => 'success'
                ]);

                // Sélectionner la nouvelle langue
                $this->selectedLanguage = $addedLang;
                $this->loadTranslations($addedLang);
            } else {
                $this->dispatch('language-update-failed', [
                    'message' => "Fichier source de traduction introuvable.",
                    'type' => 'error'
                ]);
            }
        } catch (\Exception $e) {
            $this->dispatch('language-update-failed', [
                'message' => "Erreur lors de l'ajout de la langue: " . $e->getMessage(),
                'type' => 'error'
            ]);
        }
    }

    // Modifiez également la méthode saveTranslations pour utiliser les mêmes événements
    public function saveTranslations()
    {
        try {
            // Code existant pour sauvegarder les traductions

            // Remplacer session()->flash() par dispatch()
            $this->dispatch('language-updated', [
                'message' => "Traductions pour '{$this->selectedLanguage}' enregistrées avec succès.",
                'type' => 'success'
            ]);

            // Retourner null pour éviter tout rechargement de page
            return null;
        } catch (\Exception $e) {
            $this->dispatch('language-update-failed', [
                'message' => "Erreur lors de l'enregistrement des traductions: " . $e->getMessage(),
                'type' => 'error'
            ]);

            // Retourner null pour éviter tout rechargement de page
            return null;
        }
    }

    private function varExport($var, $indent = "")
    {
        switch (gettype($var)) {
            case 'string':
                return "'" . addcslashes($var, "'\\\r\n") . "'";
            case 'array':
                $indexed = array_keys($var) === range(0, count($var) - 1);
                $r = [];
                foreach ($var as $key => $value) {
                    $r[] = "$indent    "
                        . ($indexed ? "" : $this->varExport($key) . " => ")
                        . $this->varExport($value, "$indent    ");
                }
                return "[\n" . implode(",\n", $r) . "\n" . $indent . "]";
            case 'boolean':
                return $var ? 'true' : 'false';
            case 'NULL':
                return 'null';
            case 'integer':
            case 'double':
                return $var;
            default:
                return var_export($var, true);
        }
    }

    public function render()
    {
        if (!is_array($this->translations)) {
            $this->translations = [];
        }

        // S'assurer que les traductions filtrées sont toujours à jour
        $this->updateFilteredTranslations();

        return view('livewire.manage-languages');
    }
}