<audio id="myAudio">
    <source src="https://townsvillejazzclub.s3-ap-southeast-2.amazonaws.com/bensound-thejazzpiano.mp3"
            type="audio/mpeg">
    Your browser does not support the audio element.
</audio>
<div onclick="playAudio()" type="button" class="media-player">Play Audio</div>

<script>
    var x = document.getElementById("myAudio");

    function playAudio() {
        if (x.duration > 0 && !x.paused) {
            x.pause();
        } else {
            x.play();
        }
    }
</script>