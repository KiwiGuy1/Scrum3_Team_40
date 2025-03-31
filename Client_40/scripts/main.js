$(document).ready(function () {
  const apiUrl = "../Provider_40/API_40/api.php";

  function fetchData(entity, table) {
    $.ajax({
      url: `${apiUrl}?entity=${entity}`,
      method: "GET",
      dataType: "json",
      success: function (data) {
        table.empty();
        data.forEach(function (item) {
          const row = $("<tr></tr>");
          Object.values(item).forEach(function (value) {
            const cell = $("<td></td>").text(value);
            row.append(cell);
          });
          const actions = $("<td></td>");
          const editButton = $("<button>Edit</button>").click(function () {
            openEditForm(entity, item);
          });
          const deleteButton = $("<button>Delete</button>").click(function () {
            console.log(`Deleting ${entity} with ID: ${item.id}`); // Console log item.id
            deleteEntity(entity, item.id);
          });
          actions.append(editButton).append(deleteButton);
          row.append(actions);
          table.append(row);
        });
      },
      error: function (xhr, status, error) {
        console.error("Error fetching data:", error);
      },
    });
  }

  function openEditForm(entity, item) {
    clearForm(entity);
    if (entity === "books") {
      $("#book-id").val(item.id);
      $("#book-title").val(item.title);
      $("#book-author").val(item.author);
      $("#book-genre").val(item.genre);
      $("#book-year").val(item.published_year);
      $("#add-book-button").hide();
      $("#save-book-button").show();
    } else if (entity === "members") {
      $("#member-id").val(item.id);
      $("#member-name").val(item.name);
      $("#member-date").val(item.membership_date);
      $("#member-email").val(item.email);
      $("#member-phone").val(item.phone_number);
      $("#add-member-button").hide();
      $("#save-member-button").show();
    } else if (entity === "loans") {
      $("#loan-id").val(item.id);
      $("#loan-book-id").val(item.book_id);
      $("#loan-member-id").val(item.member_id);
      $("#loan-date").val(item.loan_date);
      $("#loan-return-date").val(item.return_date);
      $("#add-loan-button").hide();
      $("#save-loan-button").show();
    }
  }

  function deleteEntity(entity, id) {
    $.ajax({
      url: `${apiUrl}`,
      method: "DELETE",
      contentType: "application/json",
      data: JSON.stringify({ entity: entity, id: id }),
      success: function () {
        fetchData(entity, $(`#${entity}-table tbody`));
      },
      error: function (xhr, status, error) {
        console.error("Error deleting data:", error);
      },
    });
  }

  function clearForm(entity) {
    if (entity === "books") {
      $("#book-form")[0].reset();
      $("#book-id").val(""); // Clear the ID field
      $("#add-book-button").show();
      $("#save-book-button").hide();
    } else if (entity === "members") {
      $("#member-form")[0].reset();
      $("#member-id").val(""); // Clear the ID field
      $("#add-member-button").show();
      $("#save-member-button").hide();
    } else if (entity === "loans") {
      $("#loan-form")[0].reset();
      $("#loan-id").val(""); // Clear the ID field
      $("#add-loan-button").show();
      $("#save-loan-button").hide();
    }
  }

  $("#book-form").submit(function (e) {
    e.preventDefault();
    const book = {
      entity: "books",
      id: $("#book-id").val(),
      title: $("#book-title").val(),
      author: $("#book-author").val(),
      genre: $("#book-genre").val(),
      published_year: $("#book-year").val(),
    };

    for (const key in book) {
      if (book.hasOwnProperty(key)) {
        console.log(`${key}: ${book[key]}`);
      }
    }

    saveEntity(book);
  });

  $("#member-form").submit(function (e) {
    e.preventDefault();
    const member = {
      entity: "members",
      id: $("#member-id").val(),
      name: $("#member-name").val(),
      membership_date: $("#member-date").val(),
      email: $("#member-email").val(),
      phone_number: $("#member-phone").val(),
    };

    for (const key in member) {
      if (member.hasOwnProperty(key)) {
        console.log(`${key}: ${member[key]}`);
      }
    }

    saveEntity(member);
  });

  $("#loan-form").submit(function (e) {
    e.preventDefault();
    const loan = {
      entity: "loans",
      id: $("#loan-id").val(),
      book_id: $("#loan-book-id").val(),
      member_id: $("#loan-member-id").val(),
      loan_date: $("#loan-date").val(),
      return_date: $("#loan-return-date").val(),
    };

    for (const key in loan) {
      if (loan.hasOwnProperty(key)) {
        console.log(`${key}: ${loan[key]}`);
      }
    }

    saveEntity(loan);
  });

  function saveEntity(entity) {
    const method = entity.id ? "PUT" : "POST";
    $.ajax({
      url: `${apiUrl}`,
      method: method,
      contentType: "application/json",
      data: JSON.stringify(entity),
      success: function () {
        fetchData(entity.entity, $(`#${entity.entity}-table tbody`));
        clearForm(entity.entity);
      },
      error: function (xhr, status, error) {
        console.error("Error saving data:", error);
      },
    });
  }

  $("#add-book-button").click(function () {
    $("#book-form").submit();
    clearForm("books");
    $("#save-book-button").show();
    $("#add-book-button").hide();
  });

  $("#add-member-button").click(function () {
    $("#member-form").submit();
    clearForm("members");
    $("#save-member-button").show();
    $("#add-member-button").hide();
  });

  $("#add-loan-button").click(function () {
    $("#loan-form").submit();
    clearForm("loans");
    $("#save-loan-button").show();
    $("#add-loan-button").hide();
  });

  $("#clear-book-button").click(function () {
    clearForm("books");
    $("#add-book-button").show();
  });

  $("#clear-member-button").click(function () {
    clearForm("members");
    $("#add-member-button").show();
  });

  $("#clear-loan-button").click(function () {
    clearForm("loans");
    $("#add-loan-button").show();
  });

  fetchData("books", $("#books-table tbody"));
  fetchData("members", $("#members-table tbody"));
  fetchData("loans", $("#loans-table tbody"));
});
