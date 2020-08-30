<a class="grouped_elements" data-fancybox="help" rel="help" href="{{ url('/assets/mba2 dkis.png') }}" style="color: white;">
    <div class="helpbt">
        <i class="far fa-question-circle" style="font-size: 32px;"></i>
        <h5 style="display: block;" id="hideCaption">Bantuan</h5>
    </div>
</a>


<script>
    $("a.grouped_elements").fancybox();
</script>

<style>

.helpbt{
    text-align: center;
    right: 0;
    bottom: 0;
    position: fixed;
    /* margin-bottom: 20px; */
    margin: 0 0 20px 0;
    padding: 5px 5px 5px 5px;
    background-color: #1f317f;
    border-radius: 20px 0px 0px 20px;   
    min-width: auto;
    min-height: auto;  
}

@media only screen and (max-width: 600px) {
    .helpbt{
    text-align: center;
    right: 0;
    bottom: 0;
    position: fixed;
    /* margin-bottom: 20px; */
    margin: 0 0 20px 0;
    padding: 5px 5px 5px 5px;
    background-color: #1f317f;
    border-radius: 20px 0px 0px 20px;   
    width: 50px;
    height: 50px;  
    }

    #hideCaption{
        display:none !important;
    }
}
</style>