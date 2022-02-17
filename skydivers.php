<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Skydivers</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <link type="text/css" rel="stylesheet" href="css/styles.css">
    </head>
    <body>
        <main class="container mt-2">
            <div class="d-flex align-items-center flex-wrap">
                <h1 class="flex-grow-1">Skydivers</h1>
                <div>
                    <a href="skydiver-details.php" class="btn btn-primary">Add a new skydiver</a>
                </div>
            </div>
            <table class="table table-light table-striped">
                <caption class="caption-top">Canadian Skydivers registered with the Canadian Sport Parachuting Association</caption>
                <thead>
                    <tr class="table-dark">
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>CSPA Number</th>
                        <th>Highest CoP</th>
                        <th>Home Dropzone</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // connect to the database
                    $db = new PDO('DB connection info hidden');
                    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                    // write the SQL command to retrieve all records from the skydivers table
                    $sql = "SELECT skydivers.*, dropzones.dropzoneName
                            FROM skydivers INNER JOIN dropzones
                            ON skydivers.homeDropzone = dropzones.dropzoneId
                            ORDER BY skydivers.firstName";

                    // preapre the SQL command
                    $cmd = $db->prepare($sql);

                    // execute the preapred SQL command
                    $cmd->execute();

                    // store the retrieved information in local variable skydivers
                    $skydivers = $cmd->fetchAll();

                    // iterate through each record and write it to the output table
                    foreach ($skydivers as $skydiver) {
                        echo '<tr>
                                <td>' . $skydiver['firstName'] . '</td>
                                <td>' . $skydiver['lastName'] . '</td>
                                <td>' . $skydiver['CSPANumber'] . '</td>
                                <td>' . $skydiver['COP'] . '</td>
                                <td>' . $skydiver['dropzoneName'] . '</td>';
                    }

                    // disconnect from the database
                    $db = null;
                    ?>
                </tbody>
            </table>
        </main>
    </body>
</html>