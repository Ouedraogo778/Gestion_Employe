<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calcul de la somme</title>
</head>
<body>
    <form action="#" method="post">
        @csrf
        <div>
            <label for="champ1">Champ 1:</label>
            <input type="number" id="champ1" name="champ1" oninput="calculerSomme()">
        </div>
        <div>
            <label for="champ2">Champ 2:</label>
            <input type="number" id="champ2" name="champ2" oninput="calculerSomme()">
        </div>
        <div>
            <label for="champ3">Champ 3:</label>
            <input type="number" id="champ3" name="champ3" oninput="calculerSomme()">
        </div>
        <div>
            <label for="champ4">Champ 4:</label>
            <input type="number" id="champ4" name="champ4" oninput="calculerSomme()">
        </div>
        <div>
            <label for="total">Total:</label>
            <input type="number" id="total" name="total" readonly>
        </div>
    </form>

    <script>
        function calculerSomme() {
            var champ1 = parseFloat(document.getElementById('champ1').value) || 0;
            var champ2 = parseFloat(document.getElementById('champ2').value) || 0;
            var champ3 = parseFloat(document.getElementById('champ3').value) || 0;
            var champ4 = parseFloat(document.getElementById('champ4').value) || 0;

            var total = champ1 + champ2 + champ3 + champ4;

            document.getElementById('total').value = total;
        }
    </script>
</body>
</html>