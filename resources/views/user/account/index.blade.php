<x-app-layout>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-alert-success>
                {{session('success')}}
            </x-alert-success>

            <table>
                <tbody>
                    <div class="row p-5">
                        <div class="col-6">
                            <div>
                                <img src="{{asset('storage/images/users/' . $user->photo)}}" width="380"/>
                             </div>
                        </div>

                        <div class="col-6">
                            <h2>
                                {{$user->name}}
                            </h2>

                            <p>
                                {{$user->email}}
                            </p>
                        </div>
                    </div>

                    <div class="text-center align-items-center row">
                        <!-- php code holder -->
                        <?php 

                        if(isset($_POST['isSubmit']))
                        {
                            // do something here
                            echo $_POST["name"];
                        }    
         
                        $result = 0;
                        //echo $result;

                        if ($result == null || $result == 0)
                        {
                            $min = 0;
                            $max = 2;
                        }
                        else
                        {
                            $min = 0 + $result;
                            $max = 2 + $result;
                        }

                        $tracker = -1;
                        ?>

                        <!-- button that was meant to move the rotator backwards -->
                        <p id="backward" onclick="back()" class="col-1 colours">
                            <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" fill="currentColor" class="bi bi-arrow-left" viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8z"/>
                            </svg>
                        </p>

                            <!-- grabs all fish -->
                            @forelse ($fish as $fish)

                                <!-- sorts fish to only fish that bleongs to this fishery -->
                                @if($fish->user_id == $user->id)

                                    <!-- increases tracker -->
                                    <?php $tracker += 1?>

                                    <!-- makes it show only three fish can appear at once -->
                                    @if($tracker >= $min && $tracker <= $max)
    
                                        <div class="col-sm-10 col-lg-3">
                                            <div class="border border-4 card m-5 ms-0 p-0" style="width: 360px">
                                                <!-- links to the indvidual fishes page -->
                                                <a href="{{ route('user.fishs.show', $fish) }}" class="whitespace-pre-wrap text-center p-0 m-0">
                                                    <img src="{{asset('storage/images/fish/' . $fish->image)}}" width="352" height="150"/>
                                                </a>

                                                <div class="noWrap">
                                                    <!-- displays the fish angler -->
                                                    <h5 class="size5">
                                                        Caught by <span class="size6">{{$fish->user->name}}</span>
                                                    </h5>

                                                    <!-- displays the type of fish -->
                                                    <h1>
                                                        {{$fish->fishType}}
                                                    </h1>

                                                    <!-- displays its price -->
                                                    <h5 class="size5">
                                                        Price €<span class="size6">{{$fish->price}}</span>
                                                    </h5>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                @endif
                            @empty
                            <p>Their are no fish on the market</p>
                        @endforelse

                        <!-- button that was meant to move the rotator forwards -->
                        <p id="forward" onclick="forw()" class="col-1 colours">
                            <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" fill="currentColor" class="bi bi-arrow-right" viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8z"/>
                            </svg>   
                        </p>
                    </div>
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>

<!-- runs the javascript -->
<script type="text/javascript">
//empty varible to be counted
var $inc = 0;

//function that when played will if able move the var $inc down three
function back()
{
    if ($inc > 0)
    {
        $inc -= 3 
        console.log($inc);
    }
}
//function that when played will if able move the var $inc down three
function forw()
{
    if ($inc < 12)
    {
        $inc += 3 
        console.log($inc);
    }
}
</script>
