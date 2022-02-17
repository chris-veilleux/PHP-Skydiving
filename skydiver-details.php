<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Skydiver Info</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <link type="text/css" rel="stylesheet" href="css/styles.css">
    </head>
    <body>
        <main class="container mt-2">
            <h1 class="text-center col-md-5">Skydiver Info</h1>
            <form method="POST" action="save-skydiver.php">
                <fieldset>
                    <legend>Enter your information:</legend>
                    <div class="form-row mt-2 col-md-5">
                        <label for="firstName" class="form-label">First Name:</label>
                        <input name="firstName" id="firstName" required max-length="50" class="col-md-3 form-control" />
                    </div>
                    <div class="form-row mt-2 col-md-5">
                        <label for="lastName" class="form-label">Last Name:</label>
                        <input name="lastName" id="lastName" required max-length="50" class="col-md-3 form-control" />
                    </div>
                    <div class="form-row mt-2 col-md-5">
                        <label for="CSPANumber" class="form-label">CSPA Number:</label>
                        <input type="number" name="CSPANumber" id="CSPANumber" min="1" max="99999" required class="col-md-3 form-control" />
                    </div>

                    <div class="form-row mt-3">
                        <p class="mb-0">Highest Certificate of Proficiency:</p>
                    </div>
                    <div class="form-check">
                        <input type="radio" id="solo" name="COP" value="Solo" class="form-check-input">
                        <label for="solo" class="form-check-label">Solo CoP</label>
                    </div>
                    <div class="form-check">
                        <input type="radio" id="a" name="COP" value="A" class="form-check-input">
                        <label for="a" class="form-check-label">A CoP</label>
                    </div>
                    <div class="form-check">
                        <input type="radio" id="b" name="COP" value="B" class="form-check-input">
                        <label for="b" class="form-check-label">B CoP</label>
                    </div>
                    <div class="form-check">
                        <input type="radio" id="c" name="COP" value="C" class="form-check-input">
                        <label for="c" class="form-check-label">C CoP</label>
                    </div>
                    <div class="form-check">
                        <input type="radio" id="d" name="COP" value="D" class="form-check-input">
                        <label for="d" class="form-check-label">D CoP</label>
                    </div>

                    <div class="form-row mt-3 col-md-5">
                        <label for="homeDropzone" class="form-label">Home Dropzone:</label>
                        <select name="homeDropzone" id="homeDropzone" class="col-md-3 form-select">
                            <?php
                            // connect to database
                            $db = new PDO('DB connection info hidden');
                            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                            // write the SQL command to return the contents of the dropzones table
                            $sql = "SELECT * FROM dropzones";
                            // prepare SQL command
                            $cmd = $db->prepare($sql);
                            // execute SQL command
                            $cmd->execute();
                            // fetchall() from SQL command
                            $dropzones = $cmd->fetchAll();
                            // use a foreach loop to populate the dropdown menu
                            foreach ($dropzones as $dropzone) {
                                echo '<option value="' . $dropzone['dropzoneId'] . '">' . $dropzone['dropzoneName'] . '</option>';
                            }
                            // close the database connection
                            $db = null;
                            ?>
                        </select>
                    </div>
                    <div class="form-row mt-4">
                        <button class="btn btn-primary col-md-5">Save New Skydiver</button>
                    </div>
                    <div class="form-row mt-2">
                        <a href="skydivers.php" class="btn btn-outline-primary col-md-5">View Existing Skydivers</a>
                    </div>
                </fieldset>
            </form>
        </main>
    </body>
</html>