{!! str_replace('</body></html>', '', $exceptionStack) !!}

    <div id="sf-resetcontent" class="sf-reset">
        <h2 class="block_exception clear_fix">
            <span class="exception_counter">R</span>
            <span class="exception_title">-- Request Information --</span>
        </h2>
        <div class="block">
            <ul class="traces list_exception">
                <li><strong>Method&nbsp;</strong>:&nbsp;{!! $request->getMethod() !!}</li>
                <li><strong>Uri&nbsp;</strong>:&nbsp;{!! $request->getUri() !!}</li>
                <li><strong>Ip&nbsp;</strong>:&nbsp;{!! $request->getClientIp() !!}</li>
                <li><strong>Referer&nbsp;</strong>:&nbsp;{!! $request->server('HTTP_REFERER') !!}</li>
                <li><strong>Is secure&nbsp;</strong>:&nbsp;{!! $request->isSecure() !!}</li>
                <li><strong>Is ajax&nbsp;</strong>:&nbsp;{!! $request->ajax() !!}</li>
                <li><strong>User agent&nbsp;</strong>:&nbsp;{!! $request->server('HTTP_USER_AGENT') !!}</li>
                <li><strong>Paramst&nbsp;</strong>:&nbsp;{!! print_r($request->all()) !!}</li>
                <li><strong>Content&nbsp;</strong>:&nbsp;{!! nl2br(htmlentities($request->getContent())) !!}</li>
            </ul>
        </div>
    </div>
</body>
</html>