<template>
    <section>
        <div id="accordionChannel" class="accordion-container">
            <div class="row">
                <div class="col">
                    <div class="card border">
                        <div class="card-header bg-black border" id="headingOne">
                            <h2 class="mb-0">
                                <a class="btn btn-link text-white" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                                    Why Support Channel? (Contributors Only)
                                </a>
                                <i class="fas fa-angle-down text-white float-right"></i>
                            </h2>
                        </div>

                        <div id="collapseOne" class="collapse " aria-labelledby="headingOne" data-parent="#accordionChannel" >
                            <div class="card-body  bg-black">
                                <div class="row text-justify">
                                    <div class="col">
                                        <textarea class="forms-text" cols="30" rows="10"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col">
                    <div class="card border">
                        <div class="card-header bg-black border" id="headingTwo">
                            <h2 class="mb-0">
                                <a class="btn btn-link text-white" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                    Edit Monthly Goal (Contributors Only)
                                </a>
                                <i class="fas fa-angle-down text-white float-right"></i>
                            </h2>
                        </div>

                        <div id="collapseTwo" class="collapse " aria-labelledby="headingTwo" data-parent="#accordionChannel" >
                            <div class="card-body  bg-black">
                                <div class="row text-justify">
                                    <div class="col">
                                        $<input type="text" class="forms-text" placeholder="0.00">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        Current total earnings from supporters = $2,143
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col text-center">
                                        Monthly Goal
                                        $2,143----------------------$3,000
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div class="card border">
                        <div class="card-header bg-black border" id="headingThree">
                            <h2 class="mb-0">
                                <a class="btn btn-link text-white" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                    Edit Tiers (Contributors Only)
                                </a>
                                <i class="fas fa-angle-down text-white float-right"></i>
                            </h2>
                        </div>

                        <div id="collapseThree" class="collapse " aria-labelledby="headingThree" data-parent="#accordionChannel" >
                            <div class="card-body  bg-black">
                                <div class="row ">
                                    <div class="col text-center">
                                        <button class="btn bg-black text-white border rounded-pill">Add Tiers</button>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <input type="text" class="forms-text" style="width: 22%" placeholder="Tier Name">
                                        <input type="text" class="forms-text" style="width: 13%" placeholder="Amount">
                                        <input type="text" class="forms-text" style="width: 55%" placeholder="Teir description">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            

            <div class="row">
                <div class="col">
                    <div class="card border">
                        <div class="card-header bg-black border" id="headingFourth">
                            <h2 class="mb-0">
                                <a class="btn btn-link text-white" type="button" data-toggle="collapse" data-target="#collapseFourth" aria-expanded="false" aria-controls="collapseFourth">
                                    View Supporters (Contributors Only)
                                </a>
                                <i class="fas fa-angle-down text-white float-right"></i>
                            </h2>
                        </div>

                        <div id="collapseFourth" class="collapse " aria-labelledby="headingFourth" data-parent="#accordionChannel" >
                            <div class="card-body  bg-black">

                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col">
                    <div class="card border">
                        <div class="card-header bg-black border" id="headingFifth">
                            <h2 class="mb-0">
                                <a class="btn btn-link text-white" type="button" data-toggle="collapse" data-target="#collapseFifth" aria-expanded="false" aria-controls="collapseFifth">
                                    View Rewards (Contributors Only)
                                </a>
                                <i class="fas fa-angle-down text-white float-right"></i>
                            </h2>
                        </div>

                        <div id="collapseFifth" class="collapse " aria-labelledby="headingFifth" data-parent="#accordionChannel" >
                            <div class="card-body  bg-black">
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col">
                    <div class="card border">
                        <div class="card-header bg-black border" id="headingSix">
                            <h2 class="mb-0">
                                <a class="btn btn-link text-white" type="button" data-toggle="collapse" data-target="#collapseSix" aria-expanded="false" aria-controls="collapseSix">
                                    View Followers
                                </a>
                                <i class="fas fa-angle-down text-white float-right"></i>
                            </h2>
                        </div>

                        <div id="collapseSix" class="collapse " aria-labelledby="headingSix" data-parent="#accordionChannel" >
                            <div class="card-body  bg-black">
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col">
                    <div class="card border">
                        <div class="card-header bg-black border" id="headingSeven">
                            <h2 class="mb-0">
                                <a class="btn btn-link text-white" type="button" data-toggle="collapse" data-target="#collapseSeven" aria-expanded="false" aria-controls="collapseSeven">
                                    View Supporting
                                </a>
                                <i class="fas fa-angle-down text-white float-right"></i>
                            </h2>
                        </div>

                        <div id="collapseSeven" class="collapse " aria-labelledby="headingSeven" data-parent="#accordionChannel" >
                            <div class="card-body  bg-black">
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col">
                    <div class="card border">
                        <div class="card-header bg-black border" id="headingEight">
                            <h2 class="mb-0">
                                <a class="btn btn-link text-white" type="button" data-toggle="collapse" data-target="#collapseEight" aria-expanded="false" aria-controls="collapseEight">
                                    View Rewarded
                                </a>
                                <i class="fas fa-angle-down text-white float-right"></i>
                            </h2>
                        </div>

                        <div id="collapseEight" class="collapse " aria-labelledby="headingEight" data-parent="#accordionChannel" >
                            <div class="card-body  bg-black">
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col">
                    <div class="card border">
                        <div class="card-header bg-black border" id="headingNine">
                            <h2 class="mb-0">
                                <a class="btn btn-link text-white" type="button" data-toggle="collapse" data-target="#collapseNine" aria-expanded="false" aria-controls="collapseNine">
                                    View Following
                                </a>
                                <i class="fas fa-angle-down text-white float-right"></i>
                            </h2>
                        </div>

                        <div id="collapseNine" class="collapse " aria-labelledby="headingNine" data-parent="#accordionChannel" >
                            <div class="card-body  bg-black">
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<script>
export default {
    
}
</script>