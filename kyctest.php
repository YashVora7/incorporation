<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CDD/KYC Risk Assessment</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        body {
    font-family: Arial, sans-serif;
    background-color: #f4f4f4;
    margin: 0;
    padding: 0;
}

.container {
    max-width: 600px;
    margin: 50px auto;
    padding: 20px;
    background-color: #fff;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

h1 {
    text-align: center;
    color: #333;
}

.form-group {
    margin-bottom: 15px;
}

label {
    display: block;
    margin-bottom: 5px;
    color: #333;
}

input, select {
    width: 100%;
    padding: 8px;
    box-sizing: border-box;
}

button {
    display: block;
    width: 100%;
    padding: 10px;
    background-color: #28a745;
    color: #fff;
    border: none;
    cursor: pointer;
}

button:hover {
    background-color: #218838;
}

#result {
    margin-top: 20px;
    padding: 10px;
    background-color: #f8f9fa;
    border: 1px solid #ddd;
}

    </style>
</head>
<body>
    <div class="container">
        <h1>CDD/KYC Risk Assessment</h1>
        <form id="riskForm">
            <div class="form-group">
                <label for="clientName">Client Name:</label>
                <input type="text" id="clientName" name="clientName" required>
            </div>
            <div class="form-group">
                <label for="age">Age:</label>
                <input type="number" id="age" name="age" required>
            </div>
            <div class="form-group">
                <label for="country">Country:</label>
                <input type="text" id="country" name="country" required>
            </div>
            <div class="form-group">
                <label for="transactionAmount">Transaction Amount ($):</label>
                <input type="number" id="transactionAmount" name="transactionAmount" required>
            </div>
            <div class="form-group">
                <label for="politicallyExposed">Politically Exposed Person:</label>
                <select id="politicallyExposed" name="politicallyExposed" required>
                    <option value="no">No</option>
                    <option value="yes">Yes</option>
                </select>
            </div>
            <button type="button" onclick="assessRisk()">Assess Risk</button>
        </form>
        <div id="result"></div>
    </div>
    <script src="script.js"></script>
</body>
<script>
    function assessRisk() {
    const age = parseInt(document.getElementById('age').value);
    const country = document.getElementById('country').value.toLowerCase();
    const transactionAmount = parseFloat(document.getElementById('transactionAmount').value);
    const politicallyExposed = document.getElementById('politicallyExposed').value;
    
    let riskScore = 0;

    // Age assessment
    if (age < 18) {
        riskScore += 3;
    } else if (age > 60) {
        riskScore += 2;
    } else {
        riskScore += 1;
    }

    // Country assessment
    const highRiskCountries = ['afghanistan', 'iran', 'iraq', 'north korea', 'syria', 'yemen'];
    if (highRiskCountries.includes(country)) {
        riskScore += 3;
    } else {
        riskScore += 1;
    }

    // Transaction amount assessment
    if (transactionAmount > 100000) {
        riskScore += 3;
    } else if (transactionAmount > 50000) {
        riskScore += 2;
    } else {
        riskScore += 1;
    }

    // Politically Exposed Person assessment
    if (politicallyExposed === 'yes') {
        riskScore += 3;
    } else {
        riskScore += 1;
    }

    let riskLevel;
    if (riskScore <= 5) {
        riskLevel = 'Low';
    } else if (riskScore <= 8) {
        riskLevel = 'Medium';
    } else {
        riskLevel = 'High';
    }

    document.getElementById('result').innerText = `Risk Level: ${riskLevel}`;
}

</script>
</html>
