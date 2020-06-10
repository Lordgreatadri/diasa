// DASHBOARD PAGE CONTROLLER
//show dashboard summary
function getDashboardSummary() {
    $.get(CONSTANTS.GET_DASHBOARD_SUMMARY_URL, function(response) {
        $('.number-of-contestants-res').html(response.data.numberOfContestants);
        $('.number-of-remaining-contestants-res').html(response.data.numberOfRemainingContestants);
        $('.number-of-evicted-contestants-res').html(response.data.numberOfEvictedContestants);
        $('.number-of-votes-res').html(response.data.numberOfTotalVotes);
        $('.number-of-momo-votes-res').html(response.data.numberOfMOMOVotes);
        $('.number-of-sms-votes-res').html(response.data.numberOfSMSVotes);
        $('.number-of-valid-votes-res').html(response.data.numberOfValidVotes);
        $('.number-of-invalid-votes-res').html(response.data.numberOfInvalidVotes);
        $('.total-revenue-res').html(`GH&cent; ` + response.data.amountForMoMoRevenue);
    })
}

// show leaderboard graph
function showLeaderBoardGraph() {
	$.get(CONSTANTS.GET_CONTESTANTS_LEADERBOARD_URL, function(response) {
        var data = response.graph.data,
            labels = response.graph.labels;

        var ctx = document.getElementById("leaderboardChart").getContext('2d');
	    drawBarChart(ctx, data, labels, 'Leading Contestant');
    })
}

// show fullscreen of results
function showLeaderBoardModal() {
    $.get(CONSTANTS.GET_CONTESTANTS_LEADERBOARD_URL, function(response) {
        var data = response.graph.data,
            labels = response.graph.labels;

        var ctx = document.getElementById("leaderBoardFullScreenChart").getContext('2d');
	    drawBarChart(ctx, data, labels, 'Leading Contestant');
    })
}

// show leaderboard results for the week
function showContestantLeaderBoardForWeek() {
    $.get(CONSTANTS.GET_WEEKLY_CONTESTANTS_LEADERBOARD_URL, function(response) {
        
        $('.data-res-placeholder-div').hide();
        var data = response.graph.data,
            labels = response.graph.labels;

        var ctx = document.getElementById("weeklyLeaderBoardChart").getContext('2d');
	    drawBarChart(ctx, data, labels, 'Leading Contestant This Week');
    })
}

function showContestantModalLeaderBoardForWeek() {
    $.get(CONSTANTS.GET_WEEKLY_CONTESTANTS_LEADERBOARD_URL, function(response) {
        var data = response.graph.data,
            labels = response.graph.labels;

        var ctx = document.getElementById("weeklyLeaderBoardFullScreenChart").getContext('2d');
	    drawBarChart(ctx, data, labels, 'Leading Contestant This Week');
    })
}

// show voters leaderboard graph
function showVotersLeaderBoardGraph() {
	$.get(CONSTANTS.GET_VOTERS_LEADERBOARD_URL, function(response) {
       
        var data = response.data.data,
            labels = response.data.labels;
            
        var ctx = document.getElementById("votersLeaderBoardChart").getContext('2d');
	    drawPieChart(ctx, data, labels);
    })
}

// show weekly voters' rankings
function showWeeklyVotersRankings() {
    $.get(CONSTANTS.GET_WEEKLY_VOTERS_LEADERBOARD_URL, function(response) {
       
        var data = response.data.data,
            labels = response.data.labels;
            
        var ctx = document.getElementById("weeklyVotersLeaderBoardChart").getContext('2d');
	    drawBarChart(ctx, data, labels, 'Highest Voter');
    })
}

// show SMS voters leaderboard graph
function showSMSVotersLeaderBoardGraph() {
	$.get(CONSTANTS.GET_SMS_VOTERS_LEADERBOARD_URL, function(response) {
       
        var data = response.data.data,
            labels = response.data.labels;
            
        if (response.success) {
            var ctx = document.getElementById("SMSVotersLeaderBoardChart").getContext('2d');
            drawPieChart(ctx, data, labels);
        }
    })
}

// show Mobile Money voters leaderboard graph
function showMOMOVotersLeaderBoardGraph() {
	$.get(CONSTANTS.GET_MOMO_VOTERS_LEADERBOARD_URL, function(response) {
       
        var data = response.data.data,
            labels = response.data.labels;
            
        var ctx = document.getElementById("MOMOVotersLeaderBoardChart").getContext('2d');
	    drawPieChart(ctx, data, labels);
    })
}

//CONTESTANTS PAGE CONTROLLER
function getContestantsSummary() {
    $.get(CONSTANTS.GET_CONTESTANTS_SUMMARY_URL, function(response) {
        if (response.success) {
            var template = ``;
            var counter = 1;
            var statusClassName = '';
            var statusBtnName = '';
            var statusName = '';
            var anim_counter = 0.2;

            if (response.data.length > 0) {

                template += `
                    <table class="table table-sm table-hover table-responsive">
                        <thead>
                            <tr>
                                <th scope="col">Position</th>
                                <th scope="col">Photo</th>
                                <th scope="col">Name</th>
                                <th scope="col">Region</th>
                                <th scope="col">Code</th>
                                <th scope="col">Votes</th>
                                <th scope="col">Status</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                `;
                response.data.forEach( function(item) {
                    var itemObj = JSON.stringify(item);

                    if (item.status == 'not_evicted') {
                        statusClassName = 'text-success';
                        statusBtnName = 'set as evicted';
                        statusName = 'contesting';
                    } else if (item.status == 'evicted'){
                        statusClassName = 'text-danger';
                        statusBtnName = 'set as not evicted';
                        statusName = 'evicted';
                        statusRowColorName = 'table-danger';
                    }

                    template += `
                        <tr class='wow zoomIn' data-wow-duration='0.8s' data-wow-delay='${anim_counter}s'>
                            <th scope="row">${counter}</th>
                            <td><img src="${item.thumbnail}" class="contestant-summary-item-img rounded-circle"></td>
                            <td>${item.name}</td>
                            <td>${item.contestant_region}</td>
                            <td>${item.contestant_num}</td>
                            <td>${item.num_of_votes}</td>
                            <td class="${statusClassName}">${statusName}</td>
                            <td>
                                <button class="btn btn-sm bg-custom" onclick='viewContestantDetails(${itemObj})'>Details</button>
                                <button class="btn btn-sm bg-info" onclick='toggleEvictionStatus(${itemObj})'>${statusBtnName}</button>
                            </td>
                        </tr>
                    `;

                    counter += 1;
                    anim_counter += 0.1;
                });

                template += `
                        </tbody>
                    </table>
                `;
            } else {
                
            }

            $('.contestants-summary-res').html(template);
        } else {
            
        }
    })
}

function viewContestantDetails(itemObj) {
    $('.contestant-img').prop('src', itemObj.thumbnail);
    $('.contestant-name').html(itemObj.name);
    $('.contestant-age').html(itemObj.age);
    $('.contestant-height').html(itemObj.height);
    $('.contestant-complexion').html(itemObj.complexion);
    $('.contestant-region').html(itemObj.contestant_region);
    $('.contestant-code').html(itemObj.contestant_num);
    $('.contestant-votes').html(itemObj.num_of_votes);
    $('.contestant-status').html(itemObj.status);

    $('#detail-modal').modal('show');
}

function toggleEvictionStatus(itemObj) {
    var confirmEviction  =  confirm('Are you sure you want to change the status of this contestant?');

    if (confirmEviction) {
        var contestantId = itemObj.contestant_id;
        
        var data = {
            contestantId: contestantId
        }

        $.post(CONSTANTS.TOGGLE_CONTESTANT_EVICTION_STATUS, data, function(response) {
            console.log(response)
            if (response.success) {
                window.location.reload();
            }
        })
    }
}

//VOTES PAGE CONTROLLER
function getRecentVotes() {
    $.get(CONSTANTS.GET_RECENT_VOTES_URL, function(response) {
        if (response.success) {
            var template = ``;
            var counter = 1;

            if (response.data.length > 0) {

                template += `
                    <table class="table table-sm table-hover data-table table-responsive">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Voter phone no.</th>
                                <th scope="col">Vote channel</th>
                                <th scope="col">Amount</th>
                                <th scope="col">Voted for</th>
                                <th scope="col">Vote date</th>
                            </tr>
                        </thead>
                        <tbody>
                `;
                response.data.forEach( function(item) {

                    template += `
                        <tr>
                            <th scope="row">${counter}</th>
                            <td>${item.number}</td>
                            <td>${item.channel}</td>
                            <td>${item.amount}</td>
                            <td>${item.nominee_name}</td>
                            <td>${item.when}</td>
                        </tr>
                    `;

                    counter += 1;
                });

                template += `
                        </tbody>
                    </table>
                `;
            } else {
                template += `
                        <div class="jumbotron">
                            <h3 class='text-center'>No Recent vote history</h3>
                        </div>
                `; 
            }

        } else {
            template += `
                    hello
            `; 
        }

        $('.recent-voters-res').html(template);
        $('.data-table').DataTable();
    })
}