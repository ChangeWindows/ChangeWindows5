@extends('layouts.app')

@section('hero')
<div class="jumbotron tabs">
    <div class="container">
        <h2 class="mb-4"><i class="fal fa-rss"></i> BuildFeed data</h2>
        <ul class="nav nav-tabs">
            <li class="nav-item">
                <a class="nav-link" href="{{ URL::to('buildfeed') }}">
                    BuildFeed
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" href="{{ URL::to('buildfeed/about') }}">
                    About
                </a>
            </li>
        </ul>
    </div>
</div>
@endsection

@section('content')
<div class="row">
    <div class="col">
        <h4>*Gasp* Are you starting Bui-</h4>
        <p><b>No.</b> We are only hosting this data as an archive of the original <a href="https://buildfeed.net">BuildFeed</a>. We have no intend to continue expanding on it. Its only purpose here is for it to be readable online in a "not-a-12-MB-JSON-file"-way. This data is the BuildFeed data, unchanged, as it was. If you're looking for the latest and greatest buildstrings from internal builds from Microsoft (or public builds, for that matter), this is not the page you want to be on.</p>
        <h4>Can we at least have some filters pretty please?</h4>
        <p>We are still building this new version of ChangeWindows, much still has to come and while we won't be expanding on this data, we will eventually make it look nice and make it filter-able.</p>
        <h4>License</h4>
        <p>Note that the following license applies to the BuildFeed data and only the BuildFeed data. This license does not correspond with ChangeWindows or its data.</p>
        <hr />
        <p>Copyright &copy; 2013-2018, The BuildFeed Team</p>
        <p>All rights reserved.</p>
        <p>Redistribution and use in source and binary forms, with or without modification, are permitted provided that the following conditions are met:</p>
        <ol>
            <li>Redistributions of source code must retain the above copyright notice, this list of conditions and the following disclaimer.</li>
            <li>Redistributions in binary form must reproduce the above copyright notice, this list of conditions and the following disclaimer in the documentation and/or other materials provided with the distribution.</li>
            <li>Neither the name of the copyright holder nor the names of its contributors may be used to endorse or promote products derived from this software without specific prior written permission.</li>
        </ol>
        <p>THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS "AS IS" AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE ARE DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT HOLDER OR CONTRIBUTORS BE LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES; LOSS OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND ON ANY THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE OF THIS SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.</p>
    </div>
</div>
@endsection

@section('modals')

@endsection