<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <!--<link rel="stylesheet" href="style.css">-->
 
<style>
  
.delete-activity-section {
  padding: 2rem;
  background: linear-gradient(to right, #caf0f8, #ade8f4);
  min-height: 100vh;
}

.delete-activity-section h2 {
  text-align: center;
  color: #023e8a;
  margin-bottom: 2rem;
}

.activity-list {
  display: flex;
  flex-wrap: wrap;
  gap: 1.5rem;
  justify-content: center;
}

.activity-card {
  background-color: white;
  border-radius: 12px;
  overflow: hidden;
  width: 300px;
  box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
  display: flex;
  flex-direction: column;
}

.activity-card img {
  width: 100%;
  height: 180px;
  object-fit: cover;
}

.activity-info {
  padding: 1rem;
  display: flex;
  flex-direction: column;
  justify-content: space-between;
}

.activity-info h3 {
  margin: 0;
  color: #0077b6;
}

.activity-info p {
  color: #555;
  margin: 0.5rem 0 1rem;
}

.btn-delete {
  background-color: #e63946;
  color: white;
  border: none;
  padding: 0.6rem 1.2rem;
  border-radius: 8px;
  cursor: pointer;
  align-self: flex-end;
  transition: background-color 0.3s;
}

.btn-delete:hover {
  background-color: #d00000;
}

</style>
</head>

<section class="delete-activity-section">
  <h2>Supprimer une activité</h2>
  <div class="activity-list">
    <div class="activity-card">
      <img src="img/voile3.jpg" alt="Planche à voile">
      <div class="activity-info">
        <h3>Planche à voile</h3>
        <p>Activité nautique passionnante pour les amateurs de vent et mer.</p>
        <button class="btn-delete">Supprimer</button>
      </div>
    </div>
      <!--autres activites plus tard..-->
  </div>
</section>

</html>