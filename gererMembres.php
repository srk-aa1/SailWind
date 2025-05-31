<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <!--<link rel="stylesheet" href="style.css">-->
</head>
<style>
  
.members-container {
  padding: 2rem;
  background: linear-gradient(to bottom right, #e0f7ff, #ccefff);
  min-height: 100vh;
}

.members-container h2 {
  text-align: center;
  color: #004080;
  margin-bottom: 2rem;
}

.members-table {
  width: 100%;
  border-collapse: collapse;
  background-color: white;
  box-shadow: 0 4px 12px rgba(0,0,0,0.1);
  border-radius: 10px;
  overflow: hidden;
}

.members-table thead {
  background-color: #0077b6;
  color: white;
}

.members-table th, .members-table td {
  padding: 1rem;
  text-align: left;
  border-bottom: 1px solid #ddd;
}

.btn-edit, .btn-delete {
  padding: 0.4rem 1rem;
  border: none;
  border-radius: 6px;
  color: white;
  cursor: pointer;
  margin-right: 0.5rem;
}

.btn-edit {
  background-color: #28a745;
}

.btn-edit:hover {
  background-color: #218838;
}

.btn-delete {
  background-color: #dc3545;
}

.btn-delete:hover {
  background-color: #c82333;
}
</style>

<section class="members-container">
  <h2>Gestion des membres</h2>

  <table class="members-table">
    <thead>
      <tr>
        <th>Nom</th>
        <th>Email</th>
        <th>Statut</th>
        <th>Actions</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td>Sarah Meriem</td>
        <td>sarah.meriem@mail.com</td>
        <td>Active</td>
        <td>
          <button class="btn-edit">Modifier</button>
          <button class="btn-delete">Supprimer</button>
        </td>
      </tr>
      <tr>
        <td>Rami Sofiane</td>
        <td>rami.sofiane@mail.com</td>
        <td>En attente</td>
        <td>
          <button class="btn-edit">Modifier</button>
          <button class="btn-delete">Supprimer</button>
        </td>
      </tr>
    </tbody>
  </table>

</section>


</html>