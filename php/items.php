<?php
    session_start();

    if(isset($_SESSION['user_id'])){
        include_once "config.php";

        if($_GET['edit']){
            $item = mysqli_real_escape_string($connection, $_GET['edit']);
            $att = mysqli_real_escape_string($connection, $_GET['att']);
            $mag = mysqli_real_escape_string($connection, $_GET['mag']);
            if($att == "-"){ $att = 0;}
            if($mag == "-"){ $mag = 0;}

            $query = "UPDATE item INNER JOIN inventory on item.item_id=inventory.item_id SET item.attack = ?, item.magic = ? where inventory.id = ?";

            $sql = $connection->prepare($query);
            $sql->bind_param("iii", $att, $mag, $item);

            echo $sql->execute();

            $sql->close();
            
        }else if($_GET['delete']){
            $item = mysqli_real_escape_string($connection, $_GET['delete']);
            $query = "DELETE FROM inventory WHERE id = ?";
            $sql = $connection->prepare($query);
            $sql->bind_param("i", $item);

            echo $sql->execute();

            $sql->close();

        }else{

            $order = mysqli_real_escape_string($connection, $_GET['order']);
            $field= mysqli_real_escape_string($connection, $_GET['field']);
            $search = mysqli_real_escape_string($connection, $_GET['search']);
            $offset = mysqli_real_escape_string($connection, $_GET['offset']);
            $output = "";
            $type = array("Sword", "Dagger", "Spear", "Bow", "Armor", "Potion", "Quest");

            if($field == "type"){
                if(array_search(ucfirst($search), $type)){
                    $search = array_search(ucfirst($search), $type) + 1;
                }
            }

            $query = "SELECT inventory.id, item.name as locale_name, users.name as owner_name, item.type, inventory.pos, inventory.amount, item.attack as att, item.magic as mag FROM inventory INNER JOIN item ON inventory.item_id=item.item_id INNER JOIN users ON users.id=inventory.owner_id ";

            $count_query = "SELECT COUNT(*) as total FROM inventory INNER JOIN item ON inventory.item_id=item.item_id INNER JOIN users ON users.id=inventory.owner_id ";


            if(!empty($search) ){

                switch($field){
                    case "id":
                        $count_query.= "WHERE inventory.id LIKE CONCAT('%', ?, '%') ";
                    break;
                    case "type":
                        $count_query.= "WHERE type LIKE CONCAT('%', ?, '%') ";
                    break;
                    case "owner":
                        $count_query.= "WHERE users.name LIKE CONCAT('%', ?, '%') ";
                    break;
                    case "name":
                    default:
                        $count_query.= "WHERE item.name LIKE CONCAT('%', ?, '%') ";
                }
                $sql = $connection->prepare($count_query);
                $sql->bind_param("s", $search);

            }else{

                $sql = $connection->prepare($count_query);

            }

            $sql->execute();
            $result = $sql->get_result();
            $count = $result->fetch_assoc();
            $output .= $count[total];
            $output .= "+";

            if(!empty($search) ){

                switch($field){
                    case "id":
                        $query.= "WHERE inventory.id LIKE CONCAT('%', ?, '%') ";
                    break;
                    case "type":
                        $query.= "WHERE type LIKE CONCAT('%', ?, '%') ";
                    break;
                    case "owner":
                        $query.= "WHERE users.name LIKE CONCAT('%', ?, '%') ";
                    break;
                    case "name":
                    default:
                        $query.= "WHERE item.name LIKE CONCAT('%', ?, '%') ";
                }
                $query.= "ORDER BY $order LIMIT ?, 8";
                $sql = $connection->prepare($query);
                $sql->bind_param("ss", $search, $offset);

            }else{

                $query .= "ORDER BY $order LIMIT ?, 8";
                $sql = $connection->prepare($query);
                $sql->bind_param("s", $offset);

            }

            $sql->execute();
            $result = $sql->get_result();

            if($result->num_rows > 0){
                while($row = $result->fetch_assoc()){
                    $output .=  '
                                <tr>
                                        <td>'.$row[id].'</td>
                                        <td>'.$row[locale_name].'</td>
                                        <td class="owner_name">'.$row[owner_name].'</td>
                                        <td>'.$type[$row[type] - 1].'</td>
                                        <td>'.$row[pos].'</td>
                                        <td>'.$row[amount].'</td>
                                        <td>'.(($row[att] != 0)?$row[att]:'-').'</td>
                                        <td>'.(($row[mag] != 0)?$row[mag]:'-').'</td>
                                        <td class="item_icon item_edit">
                                                <svg viewBox="0 0 24 24" width="20" height="20">
                                                        <use xlink:href="#svg-edit"></use>
                                                </svg>
                                        </td>
                                        <td class="item_icon item_delete">
                                                <svg viewBox="0 0 24 24" width="20" height="20">
                                                        <use xlink:href="#svg-delete"></use>
                                                </svg>
                                        </td>
                                </tr> ';
                }
                echo $output;
            }else{
                echo "0";
            }
            $sql->close();
        }

    }
?>
