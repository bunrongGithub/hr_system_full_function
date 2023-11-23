php
<?php
// Your database query
$query = "SELECT * FROM your_table";
$result = mysqli_query($connection, $query);
?>

<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php while ($row = mysqli_fetch_assoc($result)) { ?>
            <tr>
                <td><?php echo $row['id']; ?></td>
                <td><?php echo $row['name']; ?></td>
                <td><?php echo $row['email']; ?></td>
                <td>
                    <!-- Button to trigger the modal -->
                    <button class="btn btn-primary" data-toggle="modal" data-target="#modal<?php echo $row['id']; ?>">View Details</button>
                </td>
            </tr>

            <!-- Modal for each row -->
            <div class="modal fade" id="modal<?php echo $row['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="modalLabel<?php echo $row['id']; ?>">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalLabel<?php echo $row['id']; ?>">Details for <?php echo $row['name']; ?></h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <!-- Additional details for the row -->
                            <h6>Email: <?php echo $row['email']; ?></h6>
                            <!-- Add more details as needed -->
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>
    </tbody>
</table>