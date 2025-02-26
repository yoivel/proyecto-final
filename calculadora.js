function calculateEnergy() {
    // Obtener valores del formulario
    let power = document.getElementById("power").value;
    let hours = document.getElementById("hours").value;
    let rate = document.getElementById("rate").value;

    // Validar entrada
    if (!power || !hours || !rate) {
        alert("Por favor, ingrese todos los valores.");
        return;
    }

    // Cálculo: Consumo energético (kWh) = (Potencia en Watts × Horas) ÷ 1000
    let energyConsumed = (power * hours) / 1000;
    let cost = energyConsumed * rate;

    // Mostrar resultado
    document.getElementById("result").innerHTML = 
        `Consumo: ${energyConsumed.toFixed(2)} kWh/día <br>
         Costo diario: $${cost.toFixed(2)}`;
}
 
    
 
    ["8:11 a.m., 18/2/20252"] ;angel: function calculateEnergy() {
    let power = document.getElementById("power").value
    let hours = document.getElementById("hours").value
    let rate = document.getElementById("rate").value

    // Validar entrada
    if (!power || !hours || !rate) {
        alert("Por favor, ingrese todos los valores.")
        return;
    }


    let energyConsumed = (power * hours) / 1000;
    let cost = energyConsumed * rate;

    // Cálculo: Consumo energético (kWh) = (Potencia en Watts × Horas) ÷ 1000
    let energyConsume = (power * hours) / 1000;
    let cos = energyConsumed * rate;

    // Mostrar resultado
    document.getElementById("result").innerHTML = 
        `Consumo: ${energyConsumed.toFixed(2)} kWh/día <br>
         Costo diario: $${cost.toFixed(2)}`;
}
["8:11 a.m., 18/2/2025] Angel"];

