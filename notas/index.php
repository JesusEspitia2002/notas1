<?php
// Manejo de notas en el formulario
$notes = $_POST['notes'] ?? []; // Inicializar el arreglo de notas si no existe

// Botón para agregar una nota
if (isset($_POST['add_note'])) {
    $notes[] = ''; // Añadir un campo de nota vacío
}

// Botón para quitar la última nota
if (isset($_POST['remove_note']) && count($notes) > 0) {
    array_pop($notes); // Quitar el último campo de nota
}

// Calcular el promedio si se presionó "Calcular Promedio"
$average = null;
if (isset($_POST['calculate'])) {
    $validNotes = array_filter($notes, fn($note) => is_numeric($note) && $note !== '');
    if (count($validNotes) > 0) {
        $average = array_sum($validNotes) / count($validNotes);
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calculador de Notas</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <h1>Calculador de Notas</h1>
        <p>Profesora Andrea León</p>
       
    </header>

    <section id="notes-section">
        <form method="POST">
            <div id="notes-container">
                <?php foreach ($notes as $note): ?>
                    <input type="number" name="notes[]" value="<?= htmlspecialchars($note) ?>" placeholder="Ingrese nota" step="0.01">
                <?php endforeach; ?>
            </div>
            <button type="submit" name="add_note">+</button>
            <button type="submit" name="remove_note">-</button>
            <button type="submit" name="calculate">Calcular Promedio</button>
            <img src="fotos.jpg" alt="">
        </form>

        <?php if ($average !== null): ?>
            <p>Promedio de Notas: <?= round($average, 2) ?></p>
        <?php elseif (isset($_POST['calculate'])): ?>
            <p>Por favor, ingresa al menos una nota válida.</p>
        <?php endif; ?>
    </section>
</body>
</html>
