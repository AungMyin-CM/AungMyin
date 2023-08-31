@extends('layouts.app')
@section('content')
<style>
    /* RESET RULES
–––––––––––––––––––––––––––––––––––––––––––––––––– */
@import url("https://fonts.googleapis.com/css?family=Noto+Sans:400,700&display=swap");

:root {
  --white: white;
  --gray: #999;
  --lightgray: whitesmoke;
  --darkgreen: #2a9d8f;
  --popular: #ffdd40;
  --starter: #003049;
  --essential: #0372ad;
  --professional: #003049;
}

* {
  padding: 0;
  margin: 0;
  box-sizing: border-box;
}

a {
  text-decoration: none;
  color: inherit;
}

button {
  background: none;
  border: none;
  cursor: pointer;
}

table {
  border-collapse: collapse;
}

body {
  font: 18px/1.5 "Noto Sans", sans-serif;
  background: var(--lightgray);
  margin-bottom: 100px;
}

h1 {
  font-size: 2.5rem;
}

.container {
  max-width: 1000px;
  text-align: center;
  padding: 0 10px;
  margin: 0 auto;
}

.intro-text {
  padding: 50px 0;
}

.intro-text a {
  text-decoration: underline;
}

/* SWITCH STYLES
–––––––––––––––––––––––––––––––––––––––––––––––––– */
.switch-wrapper {
  position: relative;
  display: inline-flex;
  padding: 4px;
  border: 1px solid lightgrey;
  margin-bottom: 40px;
  border-radius: 30px;
  background: var(--white);
}

.switch-wrapper [type="radio"] {
  position: absolute;
  left: -9999px;
}

.switch-wrapper [type="radio"]:checked#monthly ~ label[for="monthly"],
.switch-wrapper [type="radio"]:checked#yearly ~ label[for="yearly"] {
  color: var(--white);
}

.switch-wrapper [type="radio"]:checked#monthly ~ label[for="monthly"]:hover,
.switch-wrapper [type="radio"]:checked#yearly ~ label[for="yearly"]:hover {
  background: transparent;
}

.switch-wrapper
  [type="radio"]:checked#monthly
  + label[for="yearly"]
  ~ .highlighter {
  transform: none;
}

.switch-wrapper
  [type="radio"]:checked#yearly
  + label[for="monthly"]
  ~ .highlighter {
  transform: translateX(100%);
}

.switch-wrapper label {
  font-size: 16px;
  z-index: 1;
  min-width: 100px;
  line-height: 32px;
  cursor: pointer;
  border-radius: 30px;
  transition: color 0.25s ease-in-out;
}

.switch-wrapper label:hover {
  background: var(--lightgray);
}

.switch-wrapper .highlighter {
  position: absolute;
  top: 4px;
  left: 4px;
  width: calc(50% - 4px);
  height: calc(100% - 8px);
  border-radius: 30px;
  background: var(--starter);
  transition: transform 0.25s ease-in-out;
}

/* TABLE STYLES
–––––––––––––––––––––––––––––––––––––––––––––––––– */
.table-wrapper {
  background: var(--white);
  overflow-x: auto;
}

table {
  width: 100%;
}

table tr {
  display: flex;
}

table th,
table td {
  width: 25%;
  min-width: 150px;
}

table th:nth-child(1) {
  display: flex;
  flex-direction: column;
  font-size: 1.5rem;
  line-height: 1.3;
  padding: 1rem 10px;
}

table th:nth-child(1) .svg-wrapper {
  margin-top: 10px;
}

table th:nth-child(1) svg {
  width: 22px;
  height: 22px;
}

table th .heading {
  padding: 1rem;
  color: var(--white);
}

table th:nth-child(2) .heading {
  background: var(--starter);
}

table th:nth-child(3) .heading {
  background: var(--essential);
}

table th:nth-child(4) .heading {
  background: var(--professional);
}

table th .info {
  position: relative;
  padding: 1.5rem 0;
  border-left: 1px solid var(--lightgray);
}

table th .popular {
  position: absolute;
  top: 10px;
  right: 0;
  font-size: 11px;
  background: var(--popular);
  padding: 4px 8px;
  border-radius: 2px;
}

table th .amount {
  font-size: 2rem;
}

table th .amount span {
  display: block;
  transform: translateY(-8px);
}

table th:nth-child(2) .amount {
  color: var(--starter);
}

table th:nth-child(3) .amount {
  color: var(--essential);
}

table th:nth-child(4) .amount {
  color: var(--professional);
}

table th .billing-msg,
table th .amount span {
  font-weight: normal;
  font-size: 0.8rem;
}

table th button {
  border-radius: 20px;
  padding: 8px 20px;
  margin-top: 10px;
  transition: all 0.2s;
}

table th:nth-child(2) button {
  color: var(--starter);
  border: 1px solid var(--starter);
}

table th:nth-child(2) button:hover {
  background: var(--starter);
}

table th:nth-child(3) button {
  color: var(--essential);
  border: 1px solid var(--essential);
}

table th:nth-child(3) button:hover {
  background: var(--essential);
}

table th:nth-child(4) button {
  color: var(--professional);
  border: 1px solid var(--professional);
}

table th:nth-child(4) button:hover {
  background: var(--professional);
}

table th button:hover {
  color: var(--white);
}

table td {
  padding: 10px;
}

table td:not(:first-child) {
  border-left: 1px solid var(--lightgray);
}

table td:first-child {
  font-size: 1rem;
  text-align: left;
}

table svg {
  width: 18px;
  height: 18px;
}

table svg.not-included {
  fill: var(--gray);
}

table svg.starter {
  fill: var(--starter);
}

table svg.essential {
  fill: var(--essential);
}

table svg.professional {
  fill: var(--professional);
}

table .hide {
  display: none;
}

/* MQ
–––––––––––––––––––––––––––––––––––––––––––––––––– */
@media screen and (min-width: 780px) {
  table td {
    padding: 20px;
  }
}

/* FOOTER STYLES
–––––––––––––––––––––––––––––––––––––––––––––––––– */
.page-footer {
  position: fixed;
  right: 0;
  bottom: 50px;
  display: flex;
  align-items: center;
  padding: 5px;
  z-index: 1;
  font-size: 16px;
  background: var(--lightgray);
}

.page-footer a {
  display: flex;
  margin-left: 4px;
}

@media only screen and (max-width: 450px) {

html {
    font-size: 12px;
}
}

</style>
<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper" id="mydiv">
                <div class="content-wrapper">
                    <section class="content">
                        <div class="container-fluid">
                            <div class="container">
                                <div class="container">
                                    
                                    {{-- <div class="switch-wrapper">
                                      <input id="monthly" type="radio" name="switch" checked>
                                      <input id="yearly" type="radio" name="switch">
                                      <label for="monthly">Monthly</label>
                                      <label for="yearly">Yearly</label>
                                      <span class="highlighter"></span>
                                    </div> --}}
                                    <div class="table-wrapper">
                                      <table>
                                        <thead>
                                          <tr>
                                            <th>
                                              <div>
                                                Select your plan
                                                <div class="svg-wrapper">
                                                  <svg viewBox="0 0 24 24">
                                                    <path d="M12 0c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm1 17v-4h-8v-2h8v-4l6 5-6 5z" />
                                                  </svg>
                                                </div>
                                              </div>
                                            </th>
                                            {{-- <th>
                                              <div class="heading">Starter</div>
                                              <div class="info">
                                                <div class="price monthly">
                                                  <div class="amount">$10 <span>month</span></div>
                                                </div>
                                                <div class="price yearly hide">
                                                  <div class="amount">$7 <span>month</span></div>
                                                  <div class="billing-msg">billed annually</div>
                                                </div>
                                                <button type="button">Get started</button>
                                              </div>
                                            </th>
                                            <th>
                                              <div class="heading">Essential</div>
                                              <div class="info">
                                                <div class="popular">Popular</div>
                                                <div class="price monthly">
                                                  <div class="amount">$22 <span>month</span></div>
                                                </div>
                                                <div class="price yearly hide">
                                                  <div class="amount">$17 <span>month</span></div>
                                                  <div class="billing-msg">billed annually</div>
                                                </div>
                                                <button type="button">Get started</button>
                                              </div>
                                            </th> --}}
                                            @foreach($data as $package)
                                              <th>
                                                  <div class="heading">{{ $package->name }}</div>
                                                <div class="info">
                                                  <div class="price monthly">
                                                    <div class="amount">{{ number_format($package->price) }} <span>month</span></div>
                                                  </div>
                                                  <div class="price yearly hide">
                                                    <div class="amount">$29 <span>month</span></div>
                                                    <div class="billing-msg">billed annually</div>
                                    
                                                  </div>
                                    
                                                  <button type="button"><a href="{{route('clinic.info','_token='.Crypt::encrypt($package->id).'&value=1')}}" class="nav-link">Get started</a></button><br>
                                                  <small>Free for {{$package->trialPeriod}} days</small>
                                                </div>
                                              </th>
                                            @endforeach
                                          </tr>
                                        </thead>
                                        <tbody> 
                                          <tr>
                                            <td>Patient Treatment</td>
                                            <td>
                                              <svg class="starter" viewBox="0 0 24 24">
                                                <path d="M12 0c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm-1.959 17l-4.5-4.319 1.395-1.435 3.08 2.937 7.021-7.183 1.422 1.409-8.418 8.591z" />
                                              </svg>
                                            </td>
                                            <td>
                                              <svg class="essential" viewBox="0 0 24 24">
                                                <path d="M12 0c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm-1.959 17l-4.5-4.319 1.395-1.435 3.08 2.937 7.021-7.183 1.422 1.409-8.418 8.591z" />
                                              </svg>
                                            </td>
                                            <td>
                                              <svg class="professional" viewBox="0 0 24 24">
                                                <path d="M12 0c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm-1.959 17l-4.5-4.319 1.395-1.435 3.08 2.937 7.021-7.183 1.422 1.409-8.418 8.591z" />
                                              </svg>
                                            </td>
                                          </tr>
                                          <tr>
                                            <td>Dictionary</td>
                                            <td>
                                              <svg class="starter" viewBox="0 0 24 24">
                                                <path d="M12 0c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm-1.959 17l-4.5-4.319 1.395-1.435 3.08 2.937 7.021-7.183 1.422 1.409-8.418 8.591z" />
                                              </svg>
                                            </td>
                                            <td>
                                              <svg class="essential" viewBox="0 0 24 24">
                                                <path d="M12 0c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm-1.959 17l-4.5-4.319 1.395-1.435 3.08 2.937 7.021-7.183 1.422 1.409-8.418 8.591z" />
                                              </svg>
                                            </td>
                                            <td>
                                              <svg class="professional" viewBox="0 0 24 24">
                                                <path d="M12 0c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm-1.959 17l-4.5-4.319 1.395-1.435 3.08 2.937 7.021-7.183 1.422 1.409-8.418 8.591z" />
                                              </svg>
                                            </td>
                                          </tr>
                                          <tr>
                                            <td></td>
                                            <td>
                                              <svg class="starter" viewBox="0 0 24 24">
                                                <path d="M12 0c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm-1.959 17l-4.5-4.319 1.395-1.435 3.08 2.937 7.021-7.183 1.422 1.409-8.418 8.591z" />
                                              </svg>
                                            </td>
                                            <td>
                                              <svg class="essential" viewBox="0 0 24 24">
                                                <path d="M12 0c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm-1.959 17l-4.5-4.319 1.395-1.435 3.08 2.937 7.021-7.183 1.422 1.409-8.418 8.591z" />
                                              </svg>
                                            </td>
                                            <td>
                                              <svg class="professional" viewBox="0 0 24 24">
                                                <path d="M12 0c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm-1.959 17l-4.5-4.319 1.395-1.435 3.08 2.937 7.021-7.183 1.422 1.409-8.418 8.591z" />
                                              </svg>
                                            </td>
                                          </tr>
                                          <tr>
                                            <td>Free website setup</td>
                                            <td>
                                              <svg class="starter" viewBox="0 0 24 24">
                                                <path d="M12 0c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm-1.959 17l-4.5-4.319 1.395-1.435 3.08 2.937 7.021-7.183 1.422 1.409-8.418 8.591z" />
                                              </svg>
                                            </td>
                                            <td>
                                              <svg class="essential" viewBox="0 0 24 24">
                                                <path d="M12 0c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm-1.959 17l-4.5-4.319 1.395-1.435 3.08 2.937 7.021-7.183 1.422 1.409-8.418 8.591z" />
                                              </svg>
                                            </td>
                                            <td>
                                              <svg class="professional" viewBox="0 0 24 24">
                                                <path d="M12 0c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm-1.959 17l-4.5-4.319 1.395-1.435 3.08 2.937 7.021-7.183 1.422 1.409-8.418 8.591z" />
                                              </svg>
                                            </td>
                                          </tr>
                                          
                                          <tr>
                                            <td>Unlimited websites</td>
                                            <td>
                                              <svg class="not-included" viewBox="0 0 24 24">
                                                <path d="M12 0c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm4.151 17.943l-4.143-4.102-4.117 4.159-1.833-1.833 4.104-4.157-4.162-4.119 1.833-1.833 4.155 4.102 4.106-4.16 1.849 1.849-4.1 4.141 4.157 4.104-1.849 1.849z" />
                                              </svg>
                                            </td>
                                            <td>
                                              <svg class="not-included" viewBox="0 0 24 24">
                                                <path d="M12 0c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm4.151 17.943l-4.143-4.102-4.117 4.159-1.833-1.833 4.104-4.157-4.162-4.119 1.833-1.833 4.155 4.102 4.106-4.16 1.849 1.849-4.1 4.141 4.157 4.104-1.849 1.849z" />
                                              </svg>
                                            </td>
                                            <td>
                                              <svg class="professional" viewBox="0 0 24 24">
                                                <path d="M12 0c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm-1.959 17l-4.5-4.319 1.395-1.435 3.08 2.937 7.021-7.183 1.422 1.409-8.418 8.591z" />
                                              </svg>
                                            </td>
                                          </tr>
                                        </tbody>
                                      </table>
                                    </div>
                                  </div>
                                  
                            </div>
                        </div>
                    </section>
                </div>
            </div>

            <!-- /.register-box -->
            <!-- jQuery -->

        </body>
        <script>
          const tableWrapper = document.querySelector(".table-wrapper");
          const switchInputs = document.querySelectorAll(".switch-wrapper input");
          const prices = tableWrapper.querySelectorAll(".price");
          const toggleClass = "hide";

          for (const switchInput of switchInputs) {
            switchInput.addEventListener("input", function () {
              for (const price of prices) {
                price.classList.add(toggleClass);
              }
              const activePrices = tableWrapper.querySelectorAll(
                `.price.${switchInput.id}`
              );
              for (const activePrice of activePrices) {
                activePrice.classList.remove(toggleClass);
              }
            });
          }
        </script>

@endsection
