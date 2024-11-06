<?php include('menu.php'); ?>
    <form
            method="post"
            class="form-horizontal"
    >
        <fieldset>
            <!-- Form Name -->
            <legend>
                <label style="font-weight: bold; width: 250px;">Ödeme Bilgileri</label>
            </legend>
            <!-- Text input-->
            <div class="form-group">
                <label
                        class="col-md-4 control-label"
                        for=""
                >Order Id:</label>
                <div class="col-md-4">
                    <input
                            value=""
                            name="orderId"
                            class="form-control input-md"
                    >
                </div>
            </div>

            <div class="form-group">
                <label
                        class="col-md-4 control-label"
                        for=""
                >Amount:</label>
                <div class="col-md-4">
                    <input
                            value=""
                            name="amount"
                            class="form-control input-md"
                    >
                </div>
            </div>

        </fieldset>

        <!-- Button -->
        <div class="form-group">
            <label
                    class="col-md-4 control-label"
                    for=""
            ></label>
            <div class="col-md-4">
                <button
                        type="submit"
                        id=""
                        name=""
                        class="btn btn-success"
                >Ön Otorizasyon Kapama
                </button>
            </div>
        </div>
    </form>


<?php if (!empty($_POST)): ?>
    <?php

    $settings = new Settings();

    $request = new PostAuthRequest();
    $request->OrderId = $_POST['orderId'];
    $request->Mode = $settings->Mode;
    $request->Amount = $_POST['amount'];
    $request->ClientIp = "127.0.0.1";

    $response = PostAuthRequest::execute($request, $settings);
    $output = Helper::formattoJSONOutput($response);
    print "<h3>Sonuç:</h3>";
    echo "<pre>";
    echo htmlspecialchars($output);
    echo "</pre>";

    ?>
<?php endif; ?>

<?php include('footer.php'); ?>