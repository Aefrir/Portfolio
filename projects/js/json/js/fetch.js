const electionData = function fetchPHP(){
  fetch("electiondata.php")
    .then(response => response.json())
    .then(data => {
      console.log(data);
      createTable(data);
    })
    .catch(error => {
      console.error("Niet gelukt:", error);
    });
}

function createTable(data) {
  const table = document.createElement("table");
  const headerRow = document.createElement("tr");
  
  const headers = ["Partij", "Zetels"];

  headers.forEach(headerText => {
    const th = document.createElement("th");
    th.textContent = headerText;
    headerRow.appendChild(th);
  });
  table.appendChild(headerRow);

  data.forEach(itemData => {
    const row = document.createElement("tr");
    const partyName = document.createElement("td");
    const seatCount = document.createElement("td");

    partyName.textContent = itemData.party;

    for (let i = 0; i < itemData.seats; i++){
      const icon = document.createElement("i");
      icon.classList.add("fa-solid", "fa-circle");
      icon.style.padding = "3px";
      icon.style.color = itemData.color;
      seatCount.appendChild(icon);
    }
    
    row.appendChild(partyName);
    row.appendChild(seatCount);
    table.appendChild(row);
  });

  document.body.appendChild(table);
}
electionData();