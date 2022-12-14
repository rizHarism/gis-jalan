<div id="sidebar" class="leaflet-sidebar collapsed">

    <!-- nav tabs -->
    <div class="leaflet-sidebar-tabs">
        <!-- top aligned tabs -->
        <ul role="tablist">
            <li><a href="#home" role="tab"><i class="fa fa-bars active"></i></a></li>
            <li><a href="#autopan" role="tab"><i class="fa fa-arrows"></i></a></li>
        </ul>

        <!-- bottom aligned tabs -->
        <ul role="tablist">
            <li><a href="https://github.com/nickpeihl/leaflet-sidebar-v2"><i class="fa fa-github"></i></a></li>
        </ul>
    </div>

    <!-- panel content -->
    <div class="leaflet-sidebar-content">
        <div class="leaflet-sidebar-pane" id="home">
            <h1 class="leaflet-sidebar-header">
                Layer Control
                <span class="leaflet-sidebar-close"><i class="fa fa-caret-left"></i></span>
            </h1>

            {{-- <p>A responsive sidebar for the mapping library <a href="https://leafletjs.com/">Leaflet</a>.</p>
            <p>Compatible with version 0.7 and 1.x (tested up to 1.6.0)</p>
            <p><b>Select the other panes for a showcase of each feature.</b></p>

            <h2>More examples</h2>
            <ul>
                <li><a href="./position-right.html">Right aligned</a></li>
                <li><a href="./halfheight.html">The sidebar adapts to map container size</a></li>
                <li><a href="./leaflet-latest.html">Proof that it works with the latest leaflet version (if not, please
                        report it!)</a></li>
                <li><a href="./leaflet-0.7.html">Proof that it works with leaflet 0.7</a></li>
            </ul>

            <p class="lorem">Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor
                invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo
                dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.
                Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut
                labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et
                ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.</p>
            <p class="lorem">Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor
                invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo
                dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.
                Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut
                labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et
                ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.</p>
            <p class="lorem">Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor
                invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo
                dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.
                Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut
                labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et
                ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.</p>
            <p class="lorem">Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor
                invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo
                dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.
                Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut
                labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et
                ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.</p> --}}
        </div>

        <div class="leaflet-sidebar-pane" id="autopan">
            <h1 class="leaflet-sidebar-header">
                autopan
                <span class="leaflet-sidebar-close"><i class="fa fa-caret-left"></i></span>
            </h1>
            <p>
                <code>Leaflet.control.sidebar({ autopan: true })</code>
                makes shure that the map center always stays visible.
            </p>
            <p>
                The autopan behviour is responsive as well.
                Try opening and closing the sidebar from this pane!
            </p>
        </div>

        <div class="leaflet-sidebar-pane" id="messages">
            <h1 class="leaflet-sidebar-header">Messages<span class="leaflet-sidebar-close"><i
                        class="fa fa-caret-left"></i></span></h1>
        </div>
    </div>
</div>
