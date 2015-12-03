<?php

/* @var $this yii\web\View */

$this->title = 'My Yii Application';
?>
<div class="site-index">
    <div class="jumbotron">
        <h1>Test task "books"</h1>
    </div>
    <div class="body-content">
        <div class="row">
            <div class="col-lg-12">
                <h2>Links</h2>
                <p><a href="https://www.dropbox.com/s/u1f0h2khupnbzqv/sketch.png?dl=0">site sketch</a></p>
                <p><a href="https://www.dropbox.com/s/z2gjfvtgsvfcvr2/specs.md?dl=0">requirements specification </a></p>
                <p><a href="https://github.com/skvoz/yii2_test_task">github </a></p>
                <h2>Details</h2>

                <ul>
                    <li>table 'books' (id, name, created_at, updated_at, preview, date, author_id )</li>
                    <li> table 'authors' (id, firstname, lastname)</li>
                    <li>CRUD 'books' table only register user</li>
                    <li>add search by date, firstname, book name</li>
                    <li>lightbox preview</li>
                    <li>view records as modal form</li>
                    <li>save filters data. After delete, update record see data with old filters.</li>
                    <li>other requirements in sketch</li>

                </ul>
                <h2>Some feature</h2>
                <ul>
                    <li>update record with ajax modal form</li>
                    <li>signup user, have custom validation, by FBI most wanted name. Example : joshua or wang</li>
                </ul>
            </div>
        </div>
    </div>
</div>
