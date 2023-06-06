<template>
  <div class="sales-add">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-body">
            <form>
              <div class="row">
                <div class="col-lg-4">
                  <label>Product</label>
                  <multiselect
                    v-model="selectedProduct"
                    placeholder="Pilih product"
                    label="name"
                    track-by="name"
                    name="product"
                    :close-on-select="true"
                    :clear-on-select="true"
                    :options="products"
                    :multiple="false"
                    :allow-empty="false"
                    :preselect-first="false"
                  ></multiselect>
                </div>
                <div class="col-1">
                  <label>Quantity</label>
                  <input
                    type="number"
                    name="qty"
                    class="form-control"
                    placeholder="Qty"
                    v-model="formProduct.qty"
                    required
                  />
                </div>
                <div class="col-lg-2">
                  <label style="color: white">...</label>
                  <button
                    type="button"
                    class="form-control btn btn-primary"
                    @click.prevent="addProduct"
                  >
                    Add product
                  </button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>

      <div class="col-12">
        <div class="card">
          <div class="card-body">
            <table id="datatable" class="table table-bordered table-hover">
              <thead>
                <tr class="text-center">
                  <th>Code</th>
                  <th>Product Name</th>
                  <th>Price</th>
                  <th>Qty</th>
                  <th>Total</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <tr class="text-center" v-for="(item, i) in form.sales" :key="i">
                  <td>{{ item.product.code }}</td>
                  <td>{{ item.product.name }}</td>
                  <td>{{ item.product.price }}</td>
                  <td>{{ item.qty }}</td>
                  <td>{{ item.total }}</td>
                  <td>
                    <button class="btn btn-danger" @click="del(i)">
                      <i class="fas fa-trash"></i>
                    </button>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
      <div class="col-6">
        <div class="card">
          <div class="card-body">
            <div class="form-group row">
              <label class="col-sm-3 col-form-label">Member Name</label>
              <div class="col-sm-8">
                <multiselect
                  v-model="selectedMember"
                  placeholder="Pilih member"
                  label="name"
                  track-by="name"
                  name="member"
                  :close-on-select="true"
                  :clear-on-select="true"
                  :options="members"
                  :multiple="false"
                  :allow-empty="false"
                  :preselect-first="false"
                  @input="onChangeMember"
                ></multiselect>
              </div>
            </div>

            <div class="form-group row">
              <label class="col-sm-3 col-form-label">Payment</label>
              <div class="col-sm-8">
                <select name="status" class="form-control">
                  <option value="1">Cash</option>
                  <option value="2">Credit Card</option>
                </select>
              </div>
            </div>

            <div class="form-group row">
              <label class="col-sm-3 col-form-label">Sub Total</label>
              <div class="col-sm-8">
                <input
                  type="text"
                  class="form-control"
                  v-model="form.subtotal"
                  disabled
                />
              </div>
            </div>
            <div class="form-group row">
              <label class="col-sm-3 col-form-label">Discount</label>
              <div class="col-sm-8">
                <input
                  type="text"
                  class="form-control"
                  v-model="form.discount"
                  disabled
                />
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="col-6">
        <div class="card">
          <div class="card-body">
            <div class="form-group row">
              <h2>Total : Rp. {{ formatNumber(form.grandtotal) }}</h2>
            </div>
            <button class="btn btn-success" @click.prevent="submit">
              Proccess Payment
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
export default {
  data() {
    return {
      formProduct: {},
      selectedProduct: null,
      products: [],
      selectedMember: null,
      members: [],
      form: {
        member_id: null,
        sales: [],
        subtotal: 0,
        discount: 0,
        grandtotal: 0,
      },
    };
  },
  created() {
    this.getProduct();
    this.getMember();
    this.initial();
  },
  methods: {
    initial() {
      //
    },
    async getProduct() {
      this.products = await axios.get("/product/list").then((response) => {
        return response.data;
      });
    },
    async getMember() {
      this.members = await axios.get("/member/list").then((response) => {
        return response.data;
      });
    },
    addProduct() {
      let transaction = {
        product: this.selectedProduct,
        qty: this.formProduct.qty,
        total: this.selectedProduct.price * this.formProduct.qty,
      };
      this.form.sales.push(transaction);
      this.updateSubtotal();
      this.resetFormProduct();
    },
    resetFormProduct() {
      this.selectedProduct = null;
      this.formProduct = {};
    },
    onChangeMember() {
      this.form.member_id = this.selectedMember.id;
      this.updateSubtotal();
    },
    del(i) {
      this.form.sales.splice(i, 1);
      this.updateSubtotal();
    },
    updateSubtotal() {
      let fn = (total, { product, qty }) => total + product.price * qty;
      let subtotal = this.form.sales.reduce(fn, 0);
      let discount = 0;
      if(this.selectedMember){
          discount = (10/100) * subtotal;
      }
      let grandtotal =subtotal - discount.toFixed(0);
      this.form.subtotal = subtotal;
      this.form.discount = discount.toFixed(0);
      this.form.grandtotal = grandtotal;
    },
    async submit() {
      const response = await axios.post("/sales", this.form);
      if (response.data.message == "success") {
        this.resetForm();
        window.open(`/sale/nota/${response.data.sale.id}`, '_blank');
      }
    },
    resetForm() {
      this.selectedMember = null;
      this.form = {
        member_id: null,
        sales: [],
        subtotal: 0,
        discount: 0,
        grandtotal: 0,
      };
    },
    formatNumber(number) {
      return new Intl.NumberFormat("id-ID", {
        minimumFractionDigits: 0,
      }).format(number);
    },
  },
};
</script>
