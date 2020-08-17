<template>

    <div class="p-5">

        <notifications group="notifications" />

        <div class="poker-hands-dropzone-container p-5 text-center" id="poker-hands-dropzone-container">
            <div class="dz-message needsclick position-relative">

                <div class="w-100 text-center">
                    <svg width="77" height="90" viewBox="0 0 77 90" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <g>
                            <path d="M59.3407 13.5652C59.3407 15.6522 61.0363 17.3478 63.1233 17.3478H76.819L59.3407 0V13.5652Z" fill="#E0E0E0"></path>
                            <path d="M10.9491 0.5625H58.7779V13.5652C58.7779 16.0677 60.7005 18.0408 62.9926 18.0408H76.1258V86.2174C76.1258 87.9937 74.682 89.4375 72.9057 89.4375H10.9491C9.17281 89.4375 7.729 87.9937 7.729 86.2174V3.78261C7.729 2.00631 9.17281 0.5625 10.9491 0.5625Z" fill="white" stroke="#E0E0E0" stroke-width="1.125"></path>
                            <path d="M52.6884 13.6958H0.77533V36.6523H52.6884V13.6958Z" fill="#FF4C3E"></path>
                            <path d="M0.775146 36.6523L7.16647 43.0436V36.6523H0.775146Z" fill="#C92C24"></path>
                            <path d="M63.514 72.7827H18.9053V76.0436H63.514V72.7827Z" fill="#DBDBDB"></path>
                            <path d="M63.514 64.9565H18.9053V68.2174H63.514V64.9565Z" fill="#DBDBDB"></path>
                            <path d="M63.514 57H18.9053V60.2609H63.514V57Z" fill="#DBDBDB"></path>
                            <path d="M63.5143 49.0435H18.9056V52.3043H63.5143V49.0435Z" fill="#DBDBDB"></path>
                        </g>
                    </svg>
                </div>

                <br/>

                <div class="h5 needsclick">
                    Drop the document here or <br/><span class="h5 text-primary">upload files</span>
                </div>

                <div class="text-secondary text-center w-100 space-top-3">
                    Accepted formats: TXT <br/>
                    Maximum File size 10 Mb
                </div>
            </div>

            <div id="previews">
                <div id="poker-hands-upload-template">

                    <!-- This is used as the file preview template -->
                    <div class="dz-preview">

                        <div class="dz-image"><img data-dz-thumbnail></div>

                        <div class="dz-details">

                            <div class="dz-filename w-100 px-3 pt-3 pb-1 m-0 font-weight-bold flex-row"><span data-dz-name></span></div>

                            <div class="dz-size text-left text-secondary px-3 pb-3 w-100 m-0 flex-row" data-dz-size></div>

                            <div class="progress progress-striped flex-row" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0">
                                <div class="progress-bar progress-bar-success w-0" data-dz-uploadprogress></div>
                            </div>

                        </div>

                        <button data-dz-remove class="btn btn-circle delete ml-3">
                            <svg width="12" height="12" viewBox="0 0 12 12" fill="#4868EA" xmlns="http://www.w3.org/2000/svg">
                                <path d="M11.6923 9.73572L2.28788 0.331296C1.87773 -0.0788566 1.21277 -0.0788566 0.803259 0.331296L0.307615 0.826171C-0.102538 1.23645 -0.102538 1.90141 0.307615 2.31092L9.71204 11.7153C10.1223 12.1255 10.7873 12.1255 11.1968 11.7153L11.6917 11.2205C12.1026 10.811 12.1026 10.1459 11.6923 9.73572Z" />
                                <path d="M9.71203 0.331933L0.307615 9.73635C-0.102538 10.1465 -0.102538 10.8116 0.307615 11.2211L0.80249 11.716C1.21277 12.1261 1.87773 12.1261 2.28724 11.716L11.6923 2.3122C12.1026 1.90205 12.1026 1.23709 11.6923 0.827577L11.1974 0.332702C10.7873 -0.0782202 10.1223 -0.0782202 9.71203 0.331933Z" />
                            </svg>
                        </button>

                        <button class="btn btn-circle success ml-3 d-none">
                            <svg width="22" height="16" viewBox="0 0 22 16" fill="#70D89C" xmlns="http://www.w3.org/2000/svg">
                                <path d="M21.3293 0.537986C22.0469 1.25566 22.0469 2.41901 21.3293 3.13632L9.00393 15.462C8.28626 16.1793 7.12327 16.1793 6.4056 15.462L0.538255 9.59431C-0.179418 8.877 -0.179418 7.71365 0.538255 6.99633C1.25557 6.27866 2.41892 6.27866 3.13623 6.99633L7.70459 11.5647L18.7309 0.537986C19.4486 -0.179329 20.6119 -0.179329 21.3293 0.537986Z"/>
                            </svg>
                        </button>

                    </div>

                </div>
            </div>
        </div>
        <div class="modal-footer border-0 px-4 mx-auto">
            <button class="btn btn-primary btn-lg btn-disabled poker-hands-start-upload mx-auto" disabled>Generate Report</button>
        </div>


    </div>
</template>

<script>

    import "../dropzone";

    export default
    {
        name: "UploadComponent",

        mounted()
        {

            this.createTheMostUglyWayPossibleTheDropZoneUpload();
        },

        methods:{
            /**
             * Theoretically each event should be a method :)
             * ps: no time to implement it in the "Vue way"
             * all event are here: https://www.dropzonejs.com/#events
             */
            createTheMostUglyWayPossibleTheDropZoneUpload()
            {

                // for closures
                let $that = this;

                let previewNode = document.querySelector("#poker-hands-upload-template");
                previewNode.id = "";

                let previewTemplate = previewNode.parentNode.innerHTML;
                previewNode.parentNode.removeChild(previewNode);

                let DropzoneUpload = new Dropzone('#poker-hands-dropzone-container', {

                    url: "/upload-files",

                    thumbnailWidth: 52,
                    thumbnailHeight: 52,

                    parallelUploads: 1,
                    uploadMultiple: false,

                    previewTemplate: previewTemplate,

                    autoQueue: false, // Make sure the files aren't queued until manually added
                    previewsContainer: "#previews", // Define the container to display the previews
                });

                DropzoneUpload.on("addedfile", function(file)
                {
                    // remove disable from the upload btn
                    document.querySelector(".poker-hands-start-upload").disabled = false;

                    // "placeholder"
                    document.querySelector(".dz-message").style.display = "none"
                });

                // add all docs to the queue
                document.querySelector(".poker-hands-start-upload").onclick = function()
                {
                    DropzoneUpload.enqueueFiles(DropzoneUpload.getFilesWithStatus(Dropzone.ADDED));
                };

                // when files are being uploaded
                DropzoneUpload.on("sending", function(FormData)
                {
                    // set disable to true
                    document.querySelector(".poker-hands-start-upload").setAttribute("disabled", "disabled");

                    let token = document.head.querySelector('meta[name="csrf-token"]');

                    if (token) {
                        FormData.xhr.setRequestHeader('X-CSRF-TOKEN', token.content)
                        // FormData.xhr.headers.common['X-CSRF-TOKEN'] = token.content;
                    } else {
                        console.error('CSRF token not found: https://laravel.com/docs/csrf#csrf-x-csrf-token');
                    }

                    $that.$notify({
                        group: 'notifications',
                        title: 'Please Wait',
                        text: "You will be redirected to the reports once the processing is finished!",
                        duration: -1
                    });

                });

                // when files are being removed
                DropzoneUpload.on("removedfile", function(file)
                {
                    // if we don't have any files in the queue show "placeholder"
                    if (DropzoneUpload.files.length === 0)
                    {
                        document.querySelector(".dz-message").style.display = "block";
                    }
                });

                // error
                DropzoneUpload.on("error", function(file, payload, xhr)
                {
                    for (let error in payload.errors)
                    {
                        for(let index in payload.errors[error])
                        {
                            $that.$notify({
                                group: 'notifications',
                                type: 'error',
                                title: 'Error!',
                                text: payload.errors[error][index],
                                duration: 5000
                            });
                        }
                    }
                });

                // error
                DropzoneUpload.on("success", function(file, result)
                {
                    $that.$notify({
                        group: 'notifications',
                        type: 'success',
                        title: 'Success!',
                        text: "Report with ID: " + result.data.report_id + " was generated!"
                    });

                    $that.$notify({
                        group: 'notifications',
                        title: 'Redirecting!',
                        text: "Redirecting to Report: " + result.data.report_id
                    });

                    // redirect to report
                    window.location.href = "/reports"; //+ result.data.report_id;
                });

            }
        }
    }
</script>
