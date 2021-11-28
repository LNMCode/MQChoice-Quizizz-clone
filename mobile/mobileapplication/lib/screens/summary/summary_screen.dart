import 'package:flutter/cupertino.dart';
import 'package:flutter/material.dart';
import 'package:flutter_bloc/flutter_bloc.dart';
import 'package:mobileapplication/components/constants.dart';
import 'package:mobileapplication/components/rounded_button.dart';
import 'package:mobileapplication/models/getroom/player.dart';
import 'package:mobileapplication/models/getroom/room_response.dart';
import 'package:mobileapplication/screens/entercode/entercode_screen.dart';
import 'package:mobileapplication/screens/summary/blocs/summary_bloc.dart';
import 'package:mobileapplication/screens/summary/blocs/summary_event.dart';
import 'package:mobileapplication/screens/summary/blocs/summary_state.dart';
import 'package:mobileapplication/screens/summary/models/user_ranked.dart';

class SummaryScreen extends StatefulWidget {
  final String idroom;
  final String iduser;

  const SummaryScreen({
    Key? key,
    required this.idroom,
    required this.iduser,
  }) : super(key: key);

  @override
  State<StatefulWidget> createState() => _SummaryScreen();
}

class _SummaryScreen extends State<SummaryScreen> {
  RoomResponse? _roomResponse;

  @override
  void initState() {
    super.initState();
    BlocProvider.of<SummaryBloc>(context).add(SummaryEventRequested(
      idroom: widget.idroom,
      iduser: widget.iduser,
    ));
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      body: BlocConsumer<SummaryBloc, SummaryState>(
        listener: (context, state) {
          if (state is SummarySuccessState) {
            _roomResponse = state.roomResponse;
          }
        },
        builder: (context, state) {
          if (state is SummaryLoadingState) {
            return CircularProgressIndicator();
          }
          if (state is SummaryFailState) {
            return Text('Something was wrong');
          }
          if (state is SummarySuccessState) {
            _roomResponse = state.roomResponse;
            return _Body(_roomResponse!, widget.iduser);
          }
          return Text('Some thing error');
        },
      ),
    );
  }

  Widget _Body(RoomResponse roomResponse, String iduser) {
    Size size = MediaQuery.of(context).size;
    var listPlayer = _rangedFilter(roomResponse.doc.players);
    var rank = listPlayer.indexWhere((element) => element.iduser == iduser);
    return Container(
      child: SafeArea(
        child: ListView(
          children: [
            RoundedButton(
              text: 'Find another room',
              color: kPrimaryColor,
              margin: const EdgeInsets.symmetric(vertical: 15, horizontal: 10),
              press: () {
                Navigator.pushReplacement(
                  context,
                  MaterialPageRoute(
                    builder: (context) {
                      return const EnterCodeScreen();
                    },
                  ),
                );
              },
            ),
            Container(
              height: size.height * 0.3,
              child: Center(
                child: Text("Your rank is ${rank + 1}"),
              ),
            ),
            Column(
              children: _rankedView(listPlayer),
            )
          ],
        ),
      ),
    );
  }

  List<Widget> _rankedView(List<UserRanked> list) {
    List<Widget> childs = [];
    for (final user in list) {
      var view = Container(
        padding: const EdgeInsets.symmetric(vertical: 10, horizontal: 15),
        margin: const EdgeInsets.symmetric(vertical: 5, horizontal: 10),
        height: 50,
        decoration: BoxDecoration(
          border: Border.all(color: borderColor, width: 2),
          borderRadius: BorderRadius.circular(10),
        ),
        child: Row(
          mainAxisAlignment: MainAxisAlignment.spaceBetween,
          children: [
            Text(
              user.nameuser,
              style: const TextStyle(
                fontSize: 19,
                fontWeight: FontWeight.bold,
              ),
            ),
            Text("Score: ${user.correctNumber}"),
          ],
        ),
      );
      childs.add(view);
    }
    return childs;
  }

  List<UserRanked> _rangedFilter(List<Player> players) {
    List<UserRanked> childs = [];
    for (final player in players) {
      var correctNumber = 0;
      for (final play in player.play) {
        if (play.istrue) correctNumber++;
      }
      childs.add(UserRanked(player.id, player.name, correctNumber));
    }
    childs.sort((a, b) => a.correctNumber.compareTo(b.correctNumber));
    return childs;
  }
}
