<div class="ortaDiv page">
    <div class="row">
        <div class="medium-9 columns content">
            <h1 class="anaTitle" style="display: none;" id="page-title">3 BS Alumni</h1><h2 class="anaTitle" style="display: none;" id="page-title">{{ count($students) }} BS Alumni</h2><h3 class="anaTitle" id="page-title">3 BS Alumni</h3>
            <div class="gridSistem">

                <div class="row">
                    <div  class="medium-12 columns left " >
                        <div style="position: relative;">
                            <div  class="blok gridHtml b-lazy" style="height:60px;">
                                <div class="textIcerik" id="stil932">
                                    <p>We will keep updating the success stories of our graduates at this page who had their undergraduate degree in <strong>Computer Science Engineering</strong> department at Özyeğin University.</p>                        </div>
                            </div>
                        </div>
                    </div>
                </div>

                @foreach ($students as $student)
                    <div class="row">
                        <div class="medium-12 columns left ">
                            <div style="position: relative;">
                                <div class="blok textView b-lazy" style="height:330px;background-color:#EEEEEE;">
                                    <h6 style="background-color:#FF7537;text-align:left;width:70%;color:#ffffff;border-bottom:0px solid #ffffff;">
                                        {{ $student->firstname }} {{ $student->lastname }}
                                    </h6>
                                    <div class="textIcerik" id="stil289">
                                        <img
                                            src="{{$student->imageURL}}"
                                            style="float: left; padding-right: 20px;"
                                            width="300"
                                            height="300"/>
                                        <strong>{{ $student->firstname }} {{ $student->lastname }}</strong>
                                        @foreach($student->paragraphs as $paragraph)
                                            <p>{{ $paragraph }}</p>
                                            <br>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                @endforeach
            </div>

        </div>

        <div class="medium-3 columns sagMenu">
            <div class="block " data-bid="704">
                <h4 >Computer Science Department</h4>

                <div class="menu-block-wrapper menu-block-54 menu-name-menu-mf-bilgisayar-muhendisligi parent-mlid-0 menu-level-2">
                    <ul class="menu"><li class="first leaf menu-mlid-1933 overview mid-1933"><a href="/en/computer-science-department/overview">Overview</a></li>
                        <li class="leaf menu-mlid-6058 faculty-members mid-6058"><a href="/en/computer-science-department/faculty-members">Faculty Members</a></li>
                        <li class="leaf menu-mlid-1934 research mid-1934"><a href="/en/computer-science-department/research">Research</a></li>
                        <li class="expanded menu-mlid-6030 undergraduate-education-b-sc-program- mid-6030"><span class="nolink" tabindex="0">Undergraduate Education (B. Sc. Program)</span><ul class="menu"><li class="first leaf menu-mlid-2447 about-us mid-2447"><a href="/en/computer-science-department/undergraduate-education-b-sc-program/about-us">About Us</a></li>
                                <li class="leaf menu-mlid-2377 curriculum mid-2377"><a href="/en/computer-science-department/undergraduate-education-b-sc-program/curriculum">Curriculum</a></li>
                                <li class="leaf menu-mlid-10410 courses-offered mid-10410"><a href="https://www.ozyegin.edu.tr/en/acilan-dersler?program=BSCS">Courses Offered</a></li>
                                <li class="leaf menu-mlid-2442 prerequisite-diagram mid-2442"><a href="/en/computer-science-department/undergraduate-education-b-sc-program/prerequisite-diagram">Prerequisite Diagram</a></li>
                                <li class="leaf menu-mlid-2376 courses mid-2376"><a href="/en/computer-science-department/undergraduate-education-b-sc-program/courses">Courses</a></li>
                                <li class="leaf menu-mlid-2448 double-major-and-minor-program mid-2448"><a href="/en/computer-science-department/undergraduate-education-b-sc-program/double-major-and-minor-program">Double Major and Minor Program</a></li>
                                <li class="leaf menu-mlid-2375 program-requirements mid-2375"><a href="/en/computer-science-department/undergraduate-education-b-sc-program/program-requirements">Program Requirements</a></li>
                                <li class="last leaf menu-mlid-7921 tracks mid-7921"><a href="/en/computer-science-department/undergraduate-education-b-sc-program/specialized-area-track">Tracks</a></li>
                            </ul></li>
                        <li class="leaf menu-mlid-6026 graduate-education-m-sc-and-ph-d-programs- mid-6026"><a href="https://www.ozyegin.edu.tr/en/graduate-schools/computer-science">Graduate Education (M.Sc. and Ph.D. Programs)</a></li>
                        <li class="leaf active-trail active menu-mlid-13694 id3-bs-alumni mid-13694">
                            <a href="/en/computer-science-department/3-bs-alumni" class="active-trail active">{{ count($students) }} / {{ $totalStudentNumber }} BS Alumni</a>
                        </li>
                        <li class="leaf menu-mlid-6943 announcements mid-6943"><a href="/en/computer-science-department/announcements">Announcements</a></li>
                        <li class="last leaf menu-mlid-9055 open-positions mid-9055"><a href="/en/computer-science-department/open-positions">Open Positions</a></li>
                    </ul></div>
            </div>
        </div>
    </div>
</div>
