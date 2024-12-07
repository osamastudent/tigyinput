<!-- Tagify CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tagify/4.32.1/tagify.css" integrity="sha512-fg4mbaXioGkhZsVQlBUD7MmEA5zQY4I3aiawILa2nHXUk0e5gBZjlwGoJCeRIAVHqYOdaddDQA7HUXwqx3vVAA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

<div class="col-md-6">
                        <div class="form-group">
                            <label class="">Skills</label>
                            <input type="text" placeholder="Skills" id="tags" class="form-control "
                                   value="Software,PHP,Laravel,Mysql" name="skills">
                                 
                            @error('skills')
                            <span class="text-danger ">{{ $message }}</span>
                            @enderror
                        </div>
                    </div> 

<!-- laravel controller start-->
 public function store(StoreJobRequest $request)
    {
        
        $validatedData = $request->validated();
         
    // // Process the 'skills' field to convert it to a comma-separated string
    // $skillsArray = json_decode($request->skills, true); // Decode JSON to an array
    // $validatedData['skills'] = implode(',', array_column($skillsArray, 'value')); // Extract 'value' and join with commas

        $validatedData['slug']=Str::slug($request->job_title);
        Job::create($validatedData);
        return redirect()->route('job.index')->with('success', 'Job created successfully.');
    }


<!-- update -->
public function updated(Request $request, $id)
{
    // Validate request
    $request->validate([
        'job_title' => 'required|string',
        'company' => 'required|string',
        'workplace_type' => 'required',
        'job_industry' => 'required',
        'long_description' => 'required',
        'job_location' => 'required',
        'employment_type' => 'required',
        'country' => 'required',
    ]);

    // // Process the 'skills' field
    // $skillsArray = json_decode($request->skills, true); // Decode JSON to an array
    // $skillsString = implode(',', array_column($skillsArray, 'value')); // Extract 'value' and join with commas

    // Find the job
    $job = Job::findOrFail($id);

    // Update the job record
    $job->job_title = $request->job_title;
    $job->company = $request->company;
    $job->workplace_type = $request->workplace_type;
        $job->job_industry = $request->job_industry;
    $job->long_description = $request->long_description;
    $job->job_location = $request->job_location;
    $job->employment_type = $request->employment_type;
    $job->country = $request->country;

    // Save changes
    $job->save();

    // Redirect with success message
    return back()->with('success', 'Job updated successfully');
}
<!-- laravel controller end -->


!-- Tagify JS -->
    <!--<script src="https://cdnjs.cloudflare.com/ajax/libs/tagify/4.32.1/tagify.min.js" integrity="sha512-rLrm9+wpZG0GwHDPxX5HA/QL5OKSL/v/MwJkz6wlSbpQrhKDaM1/vjQOJIQlChAXHR46mKjBVIONGldCS+sDXQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>-->

    <!-- Initialize Tagify after DOM is loaded -->
     {{-- <script>
        // document.addEventListener('DOMContentLoaded', function () {
        //     // The DOM element you wish to replace with Tagify
        //     var input = document.querySelector('input[name=skills]');

        //     // Initialize Tagify on the above input node reference
        //     new Tagify(input);
        // });
     </script>

