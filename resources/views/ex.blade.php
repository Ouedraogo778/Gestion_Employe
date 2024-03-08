<!DOCTYPE html>
<html>
<head>
    <title>Exporter en Excel</title>
</head>
<body>
    <h1>Tableau avec cases à cocher</h1>

    <table class="table">
        <thead>
            <tr>
                <th scope="col">Case à cocher</th>
                <th scope="col">Prénom</th>
                <th scope="col">Nom</th>
                <th scope="col">Identifiant</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>
                    <div class="form-check check-tables">
                        <input class="form-check-input" type="checkbox">
                    </div>
                </td>
                <td>Mark</td>
                <td>Otto</td>
                <td>@mdo</td>
            </tr>
            <tr>
                <td>
                    <div class="form-check check-tables">
                        <input class="form-check-input" type="checkbox">
                    </div>
                </td>
                <td>Jacob</td>
                <td>Thornton</td>
                <td>@fat</td>
            </tr>
            <tr>
                <td>
                    <div class="form-check check-tables">
                        <input class="form-check-input" type="checkbox">
                    </div>
                </td>
                <td >Larry</td>
                <td >Larry the Bird</td>
                <td>@twitter</td>
            </tr>
        </tbody>
    </table>

    <button onclick="copierVersExcel()">Copier vers Excel</button>

    <script>
       function copierVersExcel() {
    const lignesCochees = [];
    const rows = document.querySelectorAll('.table tbody tr');

    // Parcourez chaque ligne du tableau pour vérifier les cases cochées
    rows.forEach((row, index) => {
        const checkbox = row.querySelector('input[type="checkbox"]');
        if (checkbox && checkbox.checked) {
            lignesCochees.push(row);
        }
    });

    if (lignesCochees.length === 0) {
        alert("Sélectionnez au moins une ligne à exporter.");
        return;
    }

    // Créez une chaîne de texte pour copier dans le presse-papiers
    let excelData = "";

    // Ajoutez les données des lignes sélectionnées à la chaîne de texte
    lignesCochees.forEach((row, index) => {
        const cells = row.querySelectorAll('td');
        cells.forEach(cell => {
            excelData += cell.textContent + "\t";
        });
        excelData += "\n";
    });

    // Copiez la chaîne de texte dans le presse-papiers
    const textarea = document.createElement("textarea");
    textarea.value = excelData;
    document.body.appendChild(textarea);
    textarea.select();
    document.execCommand("copy");
    document.body.removeChild(textarea);

    alert("Les données ont été copiées. Collez-les dans Excel.");
}

    </script>
</body>
</html>
