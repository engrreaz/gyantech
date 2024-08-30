
<main class="app-content">
    <div class="app-title">
        <div>
            <h1 class="text-danger"><i class="fa fa-ban"></i> Access Deniedd</h1>
            <p>you're not authorized to access this page.</p>
        </div>
        <?php include 'breadcrumb.php'; ?>
    </div>
    <!-- ***************************************************************************************************** -->


    <div class="row ">
        <div class="col-md-12">
            <div class="tile">
                <div class="tile-body">Create a beautiful dashboard</div>
            </div>
        </div>
    </div>





    <?php echo '**********' . $usr . '++++++++'; ?>





</main>




<script>
    var toggler = document.getElementsByClassName("caret");
    var i;

    for (i = 0; i < toggler.length; i++) {
        toggler[i].addEventListener("click", function () {
            this.parentElement.querySelector(".nested").classList.toggle("active");
            this.classList.toggle("caret-down");
        });
    }
</script>


<script>
    function topi(txt) {
        document.getElementById("topicname").innerHTML = txt;
        document.getElementById("catname").innerHTML = '';
        document.getElementById("subcatname").innerHTML = '';
        document.getElementsByClassName("caret").style.color = 'red';
        console.log(100);
        //   this.style.color  = "red";
    }

    function cat(t, c) {
        event.stopPropagation();
        document.getElementById("topicname").innerHTML = t;
        document.getElementById("catname").innerHTML = c;
        document.getElementById("subcatname").innerHTML = '';
    }

    function subcat(t, c, s) {
        event.stopPropagation();
        document.getElementById("topicname").innerHTML = t;
        document.getElementById("catname").innerHTML = c;
        document.getElementById("subcatname").innerHTML = s;

    }
</script>

