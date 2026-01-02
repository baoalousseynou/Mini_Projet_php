<?php include 'actions.php'; include 'pageConnexion.php'; ?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Gestion de Tâches</title>

    <!-- BOOTSTRAP -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body class="bg-light">

    <div class="container mt-5"> 

        <h1 class="text-center mb-4">Gestion des Tâches</h1>

        <!-- ==== FORMULAIRE AJOUT / MODIFICATION ==== -->
        <div class="card mb-4 col-md-6 offset-3">
            <div class="card-header bg-primary text-white">
                <?= $tache_a_modifier ? "Modifier une tâche" : "Ajouter une tâche" ?>
            </div>

            <div class="card-body">
                <form method="POST" action="actions.php">

                    <input type="hidden" name="action" value="<?= $tache_a_modifier ? "modifier" : "ajouter" ?>">

                    <?php if ($tache_a_modifier): ?>
                        <input type="hidden" name="id" value="<?= $tache_a_modifier['id_tache'] ?>">
                    <?php endif; ?>
                    
                    <div class="mb-3">
                        <label class="form-label">Titre</label>
                        <input type="text" class="form-control" name="titre" required
                            value="<?= $tache_a_modifier['titre'] ?? '' ?>">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Description</label>
                        <textarea class="form-control" name="description" rows="3"><?= $tache_a_modifier['description'] ?? '' ?></textarea>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Statut</label>
                        <select class="form-select" name="statut">
                            <option value="en cours" <?= isset($tache_a_modifier) && $tache_a_modifier['statut'] == "en cours" ? "selected" : "" ?>>En cours</option>
                            <option value="terminée" <?= isset($tache_a_modifier) && $tache_a_modifier['statut'] == "terminée" ? "selected" : "" ?>>Terminée</option>
                        </select>
                    </div>

                     <div class="mb-3">
                        <label class="form-label">Numéro identifiant</label>
                         <select class="form-select" name="id">
                            <option value="<? $id ?>" <?= isset($tache_a_modifier) && $tache_a_modifier['id_user'] == $id ? "selected" : "" ?>><? echo $id ?></option>
                         </select>
                       
                    </div>

                    <button type="submit" class="btn btn-success">
                        <?= $tache_a_modifier ? "Enregistrer les modifications" : "Ajouter la tâche" ?>
                    </button>
                        
                    <?php if ($tache_a_modifier): ?>
                        <a href="index.php" class="btn btn-secondary">Annuler</a>
                    <?php endif; ?>

                </form>
            </div>
        </div>

        <!-- ==== LISTE DES TÂCHES ==== -->
        <h2 class="mb-3">Liste des tâches</h2>

        <div class="row">
            <?php foreach ($taches as $tache): ?>
                <div class="col-md-4">
                    <div class="card mb-3 shadow-sm">
                        <div class="card-body">

                            <h5 class="card-title">
                                <?= htmlspecialchars($tache['titre']) ?>
                            </h5>

                            <p class="card-text">
                                <?= htmlspecialchars($tache['description']) ?>
                            </p>

                            <span class="badge bg-<?= $tache['statut'] == "terminée" ? "success" : "warning" ?>">
                                <?= $tache['statut'] ?>
                            </span>

                            <hr>

                            <a href="index.php?modifier=<?= $tache['id_tache'] ?>" class="btn btn-sm btn-primary">
                                Modifier
                            </a>

                            <a href="actions.php?supprimer=<?= $tache['id_tache'] ?>"
                                class="btn btn-sm btn-danger"
                                onclick="return confirm('Supprimer cette tâche ?');">
                                Supprimer
                            </a>

                        </div>
                      </div>
                </div>
            <?php endforeach; ?>
        </div>

    </div>
    <!-- BOOTSTRAP JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>