<?php
header("Content-Type: application/json");

require 'database/db.php';
$data = json_decode(file_get_contents("php://input"), true);
$hotel_id = $data['hotel_id'];
$room_id = $data['room_id'];

$sql = "SELECT chambre_number, etat_chambre FROM chambre WHERE hotel_id = ? AND room_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ii", $hotel_id, $room_id);
$stmt->execute();
$result = $stmt->get_result();

$rooms = [];
while ($row = $result->fetch_assoc()) {
    $rooms[] = [
        "number" => $row['chambre_number'],
        "is_available" => $row['etat_chambre'] === 'disponible'
    ];
}

echo json_encode(["success" => true, "rooms" => $rooms]);

$stmt->close();
$conn->close();
?>
