$(document).ready(function () {
  function fetchData(entity, table, jsonOutput) {
    $.ajax({
      url: `../API_40/api.php?entity=${entity}`,
      method: "GET",
      dataType: "json",
      success: function (data) {
        if (table) {
          table.empty();
          data.forEach(function (item) {
            const row = $("<tr></tr>");
            Object.values(item).forEach(function (value) {
              const cell = $("<td></td>").text(value);
              row.append(cell);
            });
            table.append(row);
          });
        }
        if (jsonOutput) {
          jsonOutput.append(
            `<h3>${entity.charAt(0).toUpperCase() + entity.slice(1)}</h3>`
          );
          jsonOutput.append(
            $("<pre></pre>").text(JSON.stringify(data, null, 2))
          );
        }
      },
      error: function (xhr, status, error) {
        console.error("Error fetching data:", error);
      },
    });
  }

  const booksTable = $("#books-table tbody");
  const membersTable = $("#members-table tbody");
  const loansTable = $("#loans-table tbody");
  const jsonOutput = $("#json-output");

  // Populate the table sections
  fetchData("books", booksTable);
  fetchData("members", membersTable);
  fetchData("loans", loansTable);

  $("#fetch-json").click(function () {
    jsonOutput.empty(); // Clear previous JSON output
    fetchData("books", null, jsonOutput);
    fetchData("members", null, jsonOutput);
    fetchData("loans", null, jsonOutput);
  });
});
