<div class="api">

    <h1><i class="fa fa-fw fa-support"></i> API Documentation</h1>
    <h4>Quick Integration Manual</h4>
    <hr>
    <br>

    <h5>Overview</h5>
    <p>This quick manual will help you integrate your store or any other system to our VaucherBox management tool.</p>
    <hr>
    <br>

    <h5>Table of Methods</h5>
    <ol>
        <li><a href="#validade">Validate</a>: Used to validate a given voucher code.</li>
        <li><a href="#list">List</a>: Used to list all available voucher coude for a given recipient' e-mail address.
        </li>
    </ol>
    <hr>

    <br>
    <h5>About this API</h5>
    <p>This API is a RESTful web service and the communication protocol is JSON.</p>
    <hr>

    <br>
    <h5>API Methods</h5>
    <p>Bellow here are documented all available API methods.</p>

    <h6><a name="validade">Validate</a></h6>
    <p>This method should be called to validate a voucher code and an e-mail address. It will check if that voucher
        belongs
        to the recipients e-mail address, it will also check if it is expired or has already been used.</p>
    <p><b>URL</b>: <i>http://localhost/voucherpool/ws/voucher/validate.json</i></p>
    <p><b>Method</b>: <i>POST</i></p>
    <p><b>Required Parameters</b>:<br>
    <table>
        <thead>
        <th>Parameter</th>
        <th>Description</th>
        <th>Type</th>
        </thead>
        <tbody>
        <tr>
            <td><b>code</b></td>
            <td>Voucher code</td>
            <td>Alphanumeric, 8 characters length</td>
        </tr>
        <tr>
            <td><b>email</b></td>
            <td>Recipient' e-mail address</td>
            <td>Alphanumeric</td>
        </tr>
        </tbody>
    </table>
    <p><b>Optional Parameters</b>: None.<br>
    <p><b>Data Parameters</b>: No data in the body payload.<br>
    <p><b>Success Response</b>:<br>
    <p>In case of success, it will return a HTTP status code iquals to 200, the parameter 'return' iquals to 0 and the
        parameter discount with the reference discount allowed for that voucher. This voucher will now be marked as used
        with today' date. In the below example, the discount allowed is 15% OFF.</p>
    <ul>
        <li><b>Code</b>: 200</li>
        <li><b>Content</b>:<br>
            <code>
    {
        "return": "0",
        "discount": "15"
    }
    </code></li>
    </ul>
    <p><b>Error Response</b>:<br>
    <p>In case of error, it will return an error code in JSON, an error message and a corresponding HTTP status code as
        below:</p>
    <table>
        <thead>
        <th>HTTP Status</th>
        <th>Return Code</th>
        <th>Message</th>
        </thead>
        <tbody>
        <tr>
            <td><b>422</b></td>
            <td>1</td>
            <td>Please inform voucher code and email.</td>
        </tr>
        <tr>
            <td><b>404</b></td>
            <td>2</td>
            <td>Voucher not found.</td>
        </tr>
        <tr>
            <td><b>422</b></td>
            <td>3</td>
            <td>Voucher is expired.</td>
        </tr>
        <tr>
            <td><b>404</b></td>
            <td>4</td>
            <td>Voucher is already used.</td>
        </tr>
        </tbody>
    </table>
    <b>Error Sample</b><br>
    <code>
    {
        "return": "2",
        "message": "Voucher not found."
    }
    </code>
    </p>
    <p><b>Sample Call in Curl</b>:<br>
        <code>
    curl -X POST \
    'http://localhost/voucherpool/ws/voucher/validate.json?code=15WJGYQ32&email=john@gmail.com' \
    -H 'cache-control: no-cache' \
    -H 'content-type: application/x-www-form-urlencoded' \
        </code>


    <h6><a name="list">LIST</a></h6>
    <p>This method should be called to list which vouchers are currently available for a given recipient's e-mail
        address.</p>
    <p><b>URL</b>: <i>http://localhost/voucherpool/ws/voucher/list.json</i></p>
    <p><b>Method</b>: <i>POST</i></p>
    <p><b>Required Parameters</b>:<br>
    <table>
        <thead>
        <th>Parameter</th>
        <th>Description</th>
        <th>Type</th>
        </thead>
        <tbody>
        <tr>
            <td><b>email</b></td>
            <td>Recipient' e-mail address</td>
            <td>Alphanumeric</td>
        </tr>
        </tbody>
    </table>
    <p><b>Optional Parameters</b>: None.<br>
    <p><b>Data Parameters</b>: No data in the body payload.<br>
    <p><b>Success Response</b>:<br>
    <p>In case of success, it will return a HTTP status code iquals to 200, the parameter 'return' iquals to 0 and a
        list of currently available vouchers to be used with corresponding voucher code and offer name.</p>
    <ul>
        <li><b>Code</b>: 200</li>
        <li><b>Content</b>:<br>
            <code>
    {
        "return": "0",
            "vouchers": [
                {
                    "code": "OMG0NSXK",
                    "offer": "Birthday Discount 15%"
                }
            ]
    }
            </code></li>
    </ul>
    <p><b>Error Response</b>:<br>
    <p>In case of error, it will return an error code in JSON, an error message and a corresponding HTTP status code as
        below:</p>
    <table>
        <thead>
        <th>HTTP Status</th>
        <th>Return Code</th>
        <th>Message</th>
        </thead>
        <tbody>
        <tr>
            <td><b>422</b></td>
            <td>1</td>
            <td>Please inform recipient's email.</td>
        </tr>
        <tr>
            <td><b>404</b></td>
            <td>2</td>
            <td>No valid vouchers found.</td>
        </tr>
        </tbody>
    </table>
    <b>Error Sample</b><br>
    <code>
    {
        "return": "2",
        "message": "No valid vouchers found."
    }
    </code>
    </p>
    <p><b>Sample Call in Curl</b>:<br>
    <code>
    curl -X POST \
    'http://localhost/voucherpool/ws/voucher/list.json?email=rodrigo@digitallymade.com.br' \
    -H 'cache-control: no-cache' \
    </code>

</div>