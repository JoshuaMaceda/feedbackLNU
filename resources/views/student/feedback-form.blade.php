@extends('layout')

@section('content')
<div class="instructor-detail-container">
    <div class="card">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">Instructor Feedback Form</h4>
        </div>
        <div class="card-body">
            <div class="instructor-profile mb-4 d-flex align-items-center">
                <div class="instructor-avatar bg-j me-3" style="width: 50px; height: 50px; font-size: 20px;">J</div>
                <div>
                    <h5 class="mb-1">Dr. James Wilson</h5>
                    <div class="text-muted">Mobile Development (IT 105L)</div>
                    <div class="text-muted">Spring 2025</div>
                </div>
            </div>
            
            <form action="{{ route('feedback.store') }}" method="POST">
                @csrf
                <input type="hidden" name="instructor_id" value="1">
                
                <div class="mb-4">
                    <h5>Teaching Effectiveness</h5>
                    <div class="form-group mb-3">
                        <label class="form-label">1. How well did the instructor explain complex concepts?</label>
                        <div class="rating-group d-flex justify-content-between">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="question1" id="q1-1" value="1">
                                <label class="form-check-label" for="q1-1">1 - Poor</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="question1" id="q1-2" value="2">
                                <label class="form-check-label" for="q1-2">2</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="question1" id="q1-3" value="3">
                                <label class="form-check-label" for="q1-3">3</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="question1" id="q1-4" value="4">
                                <label class="form-check-label" for="q1-4">4</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="question1" id="q1-5" value="5">
                                <label class="form-check-label" for="q1-5">5 - Excellent</label>
                            </div>
                        </div>
                    </div>
                    
                    <div class="form-group mb-3">
                        <label class="form-label">2. How accessible was the instructor outside of class?</label>
                        <div class="rating-group d-flex justify-content-between">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="question2" id="q2-1" value="1">
                                <label class="form-check-label" for="q2-1">1 - Poor</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="question2" id="q2-2" value="2">
                                <label class="form-check-label" for="q2-2">2</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="question2" id="q2-3" value="3">
                                <label class="form-check-label" for="q2-3">3</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="question2" id="q2-4" value="4">
                                <label class="form-check-label" for="q2-4">4</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="question2" id="q2-5" value="5">
                                <label class="form-check-label" for="q2-5">5 - Excellent</label>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="mb-4">
                    <h5>Course Content</h5>
                    <div class="form-group mb-3">
                        <label class="form-label">3. How relevant was the course material to your educational goals?</label>
                        <div class="rating-group d-flex justify-content-between">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="question3" id="q3-1" value="1">
                                <label class="form-check-label" for="q3-1">1 - Not Relevant</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="question3" id="q3-2" value="2">
                                <label class="form-check-label" for="q3-2">2</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="question3" id="q3-3" value="3">
                                <label class="form-check-label" for="q3-3">3</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="question3" id="q3-4" value="4">
                                <label class="form-check-label" for="q3-4">4</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="question3" id="q3-5" value="5">
                                <label class="form-check-label" for="q3-5">5 - Very Relevant</label>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="mb-4">
                    <h5>Comments</h5>
                    <div class="form-group mb-3">
                        <label class="form-label">What did you like most about this course?</label>
                        <textarea class="form-control" name="likes" rows="3"></textarea>
                    </div>
                    
                    <div class="form-group mb-3">
                        <label class="form-label">What suggestions do you have for improving this course?</label>
                        <textarea class="form-control" name="suggestions" rows="3"></textarea>
                    </div>
                </div>
                
                <div class="text-end">
                    <button type="button" class="btn btn-secondary me-2">Save Draft</button>
                    <button type="submit" class="btn btn-primary">Submit Feedback</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection