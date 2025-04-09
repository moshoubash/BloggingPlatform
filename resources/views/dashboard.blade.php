@extends('layouts.dashboardlayout')
@section('title', 'Dashboard Overview')

@section('content')
<div class="row">
    <div class="col-lg-8 d-flex align-items-stretch">
      <div class="card w-100">
        <div class="card-body">
          <div class="d-sm-flex d-block align-items-center justify-content-between mb-9">
            <div class="mb-3 mb-sm-0">
              <h5 class="card-title fw-semibold">Content Performance</h5>
            </div>
            <div>
              <select class="form-select">
                <option value="1">March 2025</option>
                <option value="2">April 2025</option>
                <option value="3">May 2025</option>
                <option value="4">June 2025</option>
              </select>
            </div>
          </div>
          <div id="chart"></div>
        </div>
      </div>
    </div>
    <div class="col-lg-4">
      <div class="row">
        <div class="col-lg-12">
          <!-- Audience Growth -->
          <div class="card overflow-hidden">
            <div class="card-body p-4">
              <h5 class="card-title mb-9 fw-semibold">Audience Growth</h5>
              <div class="row align-items-center">
                <div class="col-8">
                  <h4 class="fw-semibold mb-3">18,652</h4>
                  <div class="d-flex align-items-center mb-3">
                    <span
                      class="me-1 rounded-circle bg-light-success round-20 d-flex align-items-center justify-content-center">
                      <i class="ti ti-arrow-up-left text-success"></i>
                    </span>
                    <p class="text-dark me-1 fs-3 mb-0">+12%</p>
                    <p class="fs-3 mb-0">last month</p>
                  </div>
                  <div class="d-flex align-items-center">
                    <div class="me-4">
                      <span class="round-8 bg-primary rounded-circle me-2 d-inline-block"></span>
                      <span class="fs-2">Subscribers</span>
                    </div>
                    <div>
                      <span class="round-8 bg-light-primary rounded-circle me-2 d-inline-block"></span>
                      <span class="fs-2">Visitors</span>
                    </div>
                  </div>
                </div>
                <div class="col-4">
                  <div class="d-flex justify-content-center">
                    <div id="breakup"></div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-12">
          <!-- Engagement Stats -->
          <div class="card">
            <div class="card-body">
              <div class="row align-items-start">
                <div class="col-8">
                  <h5 class="card-title mb-9 fw-semibold">Engagement Stats</h5>
                  <h4 class="fw-semibold mb-3">1,240</h4>
                  <div class="d-flex align-items-center pb-1">
                    <span
                      class="me-2 rounded-circle bg-light-success round-20 d-flex align-items-center justify-content-center">
                      <i class="ti ti-arrow-up-right text-success"></i>
                    </span>
                    <p class="text-dark me-1 fs-3 mb-0">+8%</p>
                    <p class="fs-3 mb-0">last week</p>
                  </div>
                </div>
                <div class="col-4">
                  <div class="d-flex justify-content-end">
                    <div
                      class="text-white bg-secondary rounded-circle p-6 d-flex align-items-center justify-content-center">
                      <i class="ti ti-message-circle fs-6"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div id="engagement"></div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-lg-4 d-flex align-items-stretch">
      <div class="card w-100">
        <div class="card-body p-4">
          <div class="mb-4">
            <h5 class="card-title fw-semibold">Recent Comments</h5>
          </div>
          <ul class="timeline-widget mb-0 position-relative mb-n5">
            <li class="timeline-item d-flex position-relative overflow-hidden">
              <div class="timeline-time text-dark flex-shrink-0 text-end">09:30</div>
              <div class="timeline-badge-wrap d-flex flex-column align-items-center">
                <span class="timeline-badge border-2 border border-primary flex-shrink-0 my-8"></span>
                <span class="timeline-badge-border d-block flex-shrink-0"></span>
              </div>
              <div class="timeline-desc fs-3 text-dark mt-n1">New comment from Sarah on "10 Tips for Better Writing"</div>
            </li>
            <li class="timeline-item d-flex position-relative overflow-hidden">
              <div class="timeline-time text-dark flex-shrink-0 text-end">10:00 am</div>
              <div class="timeline-badge-wrap d-flex flex-column align-items-center">
                <span class="timeline-badge border-2 border border-info flex-shrink-0 my-8"></span>
                <span class="timeline-badge-border d-block flex-shrink-0"></span>
              </div>
              <div class="timeline-desc fs-3 text-dark mt-n1 fw-semibold">Your reply approved <a
                  href="javascript:void(0)" class="text-primary d-block fw-normal">#COM-3467</a>
              </div>
            </li>
            <li class="timeline-item d-flex position-relative overflow-hidden">
              <div class="timeline-time text-dark flex-shrink-0 text-end">12:00 pm</div>
              <div class="timeline-badge-wrap d-flex flex-column align-items-center">
                <span class="timeline-badge border-2 border border-success flex-shrink-0 my-8"></span>
                <span class="timeline-badge-border d-block flex-shrink-0"></span>
              </div>
              <div class="timeline-desc fs-3 text-dark mt-n1">Comment moderation needed on "SEO Strategies"</div>
            </li>
            <li class="timeline-item d-flex position-relative overflow-hidden">
              <div class="timeline-time text-dark flex-shrink-0 text-end">02:30 pm</div>
              <div class="timeline-badge-wrap d-flex flex-column align-items-center">
                <span class="timeline-badge border-2 border border-warning flex-shrink-0 my-8"></span>
                <span class="timeline-badge-border d-block flex-shrink-0"></span>
              </div>
              <div class="timeline-desc fs-3 text-dark mt-n1 fw-semibold">New discussion started <a
                  href="javascript:void(0)" class="text-primary d-block fw-normal">#DC-2195</a>
              </div>
            </li>
            <li class="timeline-item d-flex position-relative overflow-hidden">
              <div class="timeline-time text-dark flex-shrink-0 text-end">04:15 pm</div>
              <div class="timeline-badge-wrap d-flex flex-column align-items-center">
                <span class="timeline-badge border-2 border border-danger flex-shrink-0 my-8"></span>
                <span class="timeline-badge-border d-block flex-shrink-0"></span>
              </div>
              <div class="timeline-desc fs-3 text-dark mt-n1 fw-semibold">Flagged comment detected
              </div>
            </li>
            <li class="timeline-item d-flex position-relative overflow-hidden">
              <div class="timeline-time text-dark flex-shrink-0 text-end">05:00 pm</div>
              <div class="timeline-badge-wrap d-flex flex-column align-items-center">
                <span class="timeline-badge border-2 border border-success flex-shrink-0 my-8"></span>
              </div>
              <div class="timeline-desc fs-3 text-dark mt-n1">All comments reviewed</div>
            </li>
          </ul>
        </div>
      </div>
    </div>
    <div class="col-lg-8 d-flex align-items-stretch">
      <div class="card w-100">
        <div class="card-body p-4">
          <h5 class="card-title fw-semibold mb-4">Content Status</h5>
          <div class="table-responsive">
            <table class="table text-nowrap mb-0 align-middle">
              <thead class="text-dark fs-4">
                <tr>
                  <th class="border-bottom-0">
                    <h6 class="fw-semibold mb-0">ID</h6>
                  </th>
                  <th class="border-bottom-0">
                    <h6 class="fw-semibold mb-0">Author</h6>
                  </th>
                  <th class="border-bottom-0">
                    <h6 class="fw-semibold mb-0">Post Title</h6>
                  </th>
                  <th class="border-bottom-0">
                    <h6 class="fw-semibold mb-0">Status</h6>
                  </th>
                  <th class="border-bottom-0">
                    <h6 class="fw-semibold mb-0">Views</h6>
                  </th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td class="border-bottom-0"><h6 class="fw-semibold mb-0">1</h6></td>
                  <td class="border-bottom-0">
                      <h6 class="fw-semibold mb-1">Emma Thompson</h6>
                      <span class="fw-normal">Senior Writer</span>                          
                  </td>
                  <td class="border-bottom-0">
                    <p class="mb-0 fw-normal">The Future of Content Marketing</p>
                  </td>
                  <td class="border-bottom-0">
                    <div class="d-flex align-items-center gap-2">
                      <span class="badge bg-success rounded-3 fw-semibold">Published</span>
                    </div>
                  </td>
                  <td class="border-bottom-0">
                    <h6 class="fw-semibold mb-0 fs-4">3.9K</h6>
                  </td>
                </tr> 
                <tr>
                  <td class="border-bottom-0"><h6 class="fw-semibold mb-0">2</h6></td>
                  <td class="border-bottom-0">
                      <h6 class="fw-semibold mb-1">Marcus Chen</h6>
                      <span class="fw-normal">Tech Editor</span>                          
                  </td>
                  <td class="border-bottom-0">
                    <p class="mb-0 fw-normal">10 AI Tools for Bloggers</p>
                  </td>
                  <td class="border-bottom-0">
                    <div class="d-flex align-items-center gap-2">
                      <span class="badge bg-primary rounded-3 fw-semibold">Draft</span>
                    </div>
                  </td>
                  <td class="border-bottom-0">
                    <h6 class="fw-semibold mb-0 fs-4">N/A</h6>
                  </td>
                </tr> 
                <tr>
                  <td class="border-bottom-0"><h6 class="fw-semibold mb-0">3</h6></td>
                  <td class="border-bottom-0">
                      <h6 class="fw-semibold mb-1">Sophia Patel</h6>
                      <span class="fw-normal">Lifestyle Writer</span>                          
                  </td>
                  <td class="border-bottom-0">
                    <p class="mb-0 fw-normal">Sustainable Living Guide</p>
                  </td>
                  <td class="border-bottom-0">
                    <div class="d-flex align-items-center gap-2">
                      <span class="badge bg-warning rounded-3 fw-semibold">In Review</span>
                    </div>
                  </td>
                  <td class="border-bottom-0">
                    <h6 class="fw-semibold mb-0 fs-4">N/A</h6>
                  </td>
                </tr>      
                <tr>
                  <td class="border-bottom-0"><h6 class="fw-semibold mb-0">4</h6></td>
                  <td class="border-bottom-0">
                      <h6 class="fw-semibold mb-1">Jamal Wilson</h6>
                      <span class="fw-normal">Finance Editor</span>                          
                  </td>
                  <td class="border-bottom-0">
                    <p class="mb-0 fw-normal">Investing for Beginners</p>
                  </td>
                  <td class="border-bottom-0">
                    <div class="d-flex align-items-center gap-2">
                      <span class="badge bg-success rounded-3 fw-semibold">Published</span>
                    </div>
                  </td>
                  <td class="border-bottom-0">
                    <h6 class="fw-semibold mb-0 fs-4">2.4K</h6>
                  </td>
                </tr>                       
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-sm-6 col-xl-3">
      <div class="card overflow-hidden rounded-2">
        <div class="position-relative">
          <a href="javascript:void(0)"><img src="/api/placeholder/400/240" class="card-img-top rounded-0" alt="Blog post thumbnail"></a>
          <a href="javascript:void(0)" class="bg-primary rounded-circle p-2 text-white d-inline-flex position-absolute bottom-0 end-0 mb-n3 me-3" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Edit Post"><i class="ti ti-edit fs-4"></i></a>
        </div>
        <div class="card-body pt-3 p-4">
          <h6 class="fw-semibold fs-4">Essential Writing Tools</h6>
          <div class="d-flex align-items-center justify-content-between">
            <h6 class="fw-semibold fs-4 mb-0">1.2K <span class="ms-2 fw-normal text-muted fs-3">views</span></h6>
            <ul class="list-unstyled d-flex align-items-center mb-0">
              <li><a class="me-1" href="javascript:void(0)"><i class="ti ti-heart text-danger"></i></a></li>
              <li><a class="" href="javascript:void(0)"><i class="ti ti-message text-primary"></i></a></li>
            </ul>
          </div>
        </div>
      </div>
    </div>
    <div class="col-sm-6 col-xl-3">
      <div class="card overflow-hidden rounded-2">
        <div class="position-relative">
          <a href="javascript:void(0)"><img src="/api/placeholder/400/240" class="card-img-top rounded-0" alt="Blog post thumbnail"></a>
          <a href="javascript:void(0)" class="bg-primary rounded-circle p-2 text-white d-inline-flex position-absolute bottom-0 end-0 mb-n3 me-3" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Edit Post"><i class="ti ti-edit fs-4"></i></a>
        </div>
        <div class="card-body pt-3 p-4">
          <h6 class="fw-semibold fs-4">Remote Work Essentials</h6>
          <div class="d-flex align-items-center justify-content-between">
            <h6 class="fw-semibold fs-4 mb-0">3.5K <span class="ms-2 fw-normal text-muted fs-3">views</span></h6>
            <ul class="list-unstyled d-flex align-items-center mb-0">
              <li><a class="me-1" href="javascript:void(0)"><i class="ti ti-heart text-danger"></i></a></li>
              <li><a class="" href="javascript:void(0)"><i class="ti ti-message text-primary"></i></a></li>
            </ul>
          </div>
        </div>
      </div>
    </div>
    
    <div class="col-sm-6 col-xl-3">
      <div class="card overflow-hidden rounded-2">
        <div class="position-relative">
          <a href="javascript:void(0)"><img src="/api/placeholder/400/240" class="card-img-top rounded-0" alt="Blog post thumbnail"></a>
          <a href="javascript:void(0)" class="bg-primary rounded-circle p-2 text-white d-inline-flex position-absolute bottom-0 end-0 mb-n3 me-3" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Edit Post"><i class="ti ti-edit fs-4"></i></a>
        </div>
        <div class="card-body pt-3 p-4">
          <h6 class="fw-semibold fs-4">Photography for Bloggers</h6>
          <div class="d-flex align-items-center justify-content-between">
            <h6 class="fw-semibold fs-4 mb-0">985 <span class="ms-2 fw-normal text-muted fs-3">views</span></h6>
            <ul class="list-unstyled d-flex align-items-center mb-0">
              <li><a class="me-1" href="javascript:void(0)"><i class="ti ti-heart text-danger"></i></a></li>
              <li><a class="" href="javascript:void(0)"><i class="ti ti-message text-primary"></i></a></li>
            </ul>
          </div>
        </div>
      </div>
    </div>
    <div class="col-sm-6 col-xl-3">
        <div class="card overflow-hidden rounded-2">
          <div class="position-relative">
            <a href="javascript:void(0)"><img src="/api/placeholder/400/240" class="card-img-top rounded-0" alt="Blog post thumbnail"></a>
            <a href="javascript:void(0)" class="bg-primary rounded-circle p-2 text-white d-inline-flex position-absolute bottom-0 end-0 mb-n3 me-3" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Edit Post"><i class="ti ti-edit fs-4"></i></a>
          </div>
          <div class="card-body pt-3 p-4">
            <h6 class="fw-semibold fs-4">SEO Tips and Tricks</h6>
            <div class="d-flex align-items-center justify-content-between">
              <h6 class="fw-semibold fs-4 mb-0">2.7K <span class="ms-2 fw-normal text-muted fs-3">views</span></h6>
              <ul class="list-unstyled d-flex align-items-center mb-0">
                <li><a class="me-1" href="javascript:void(0)"><i class="ti ti-heart text-danger"></i></a></li>
                <li><a class="" href="javascript:void(0)"><i class="ti ti-message text-primary"></i></a></li>
              </ul>
            </div>
          </div>
        </div>
      </div>
  </div>
@endsection