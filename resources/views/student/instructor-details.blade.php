@extends('layout')

@section('content')
<div class="instructor-detail-container">
    <div class="card">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">Instructor Details</h4>
        </div>
        <div class="card-body">
            <div class="instructor-profile mb-4 d-flex align-items-center">
                <div class="instructor-avatar bg-j me-3" style="width: 60px; height: 60px; font-size: 24px;">J</div>
                <div>
                    <h3 class="mb-1">Dr. James Wilson</h3>
                    <div class="text-muted fs-5">Mobile Development</div>
                    <div class="text-muted">IT 105L • Spring 2025</div>
                </div>
            </div>
            
            <div class="instructor-stats mb-4">
                <div class="row">
                    <div class="col-md-4">
                        <div class="card bg-light">
                            <div class="card-body text-center">
                                <h5>Teaching Experience</h5>
                                <div class="fs-2 fw-bold text-primary">8 Years</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card bg-light">
                            <div class="card-body text-center">
                                <h5>Courses Taught</h5>
                                <div class="fs-2 fw-bold text-primary">12</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card bg-light">
                            <div class="card-body text-center">
                                <h5>Rating</h5>
                                <div class="fs-2 fw-bold text-primary">4.8/5</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="course-details mb-4">
                <h4>Course Information</h4>
                <div class="card">
                    <div class="card-body">
                        <div class="row mb-3">
                            <div class="col-md-3 fw-bold">Course Description:</div>
                            <div class="col-md-9">
                                This course introduces students to modern mobile application development principles, 
                                patterns, and practices. Topics include UI/UX design for mobile, 
                                cross-platform development, and performance optimization.
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-3 fw-bold">Schedule:</div>
                            <div class="col-md-9">
                                Monday & Wednesday, 2:00 PM - 3:30 PM
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-3 fw-bold">Location:</div>
                            <div class="col-md-9">
                                Tech Building, Room 305
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-3 fw-bold">Credits:</div>
                            <div class="col-md-9">
                                3 credits
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="text-center">
                <a href="{{ route('feedback.create', ['instructor' => 1]) }}" class="btn btn-primary btn-lg">Provide Feedback</a>
            </div>
        </div>
    </div>
</div>
@endsection